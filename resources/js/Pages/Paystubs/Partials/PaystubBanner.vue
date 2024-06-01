<script setup>
import { computed } from 'vue';
import PaidIcon from '@/Components/Icons/PaidIcon.vue';

const props = defineProps({
  paystub: Object,
});

const formattedPaystub = computed(() => {
  return {
    id: props.paystub.id,
    issuer:
      props.paystub?.issuer ?? props.paystub?.paystub?.issuer ?? 'Unknown',
    amount: props.paystub?.amount ?? props.paystub?.paystub?.amount ?? '$0.00',
    payDate: props.paystub?.paystub ? props.paystub?.pay_date : null,
    notes: props.paystub?.notes ?? props.paystub?.paystub?.notes ?? '',
    isDeposited: props.paystub?.is_deposited ?? false,
  };
});

const paystubUrl = computed(() => {
  if (props.paystub?.paystub) {
    return route('monthly-paystubs.show', props.paystub.id);
  }

  return route('paystubs.show', props.paystub.id);
});

const recurrenceText = computed(() => {
  let rate =
    props.paystub?.recurrence_rate ?? props.paystub?.paystub?.recurrence_rate;
  rate = rate.charAt(0).toUpperCase() + rate.slice(1);

  let final = `${rate}, every ${props.paystub?.interval_one ?? props.paystub?.paystub?.interval_one}`;

  if (props.paystub?.interval_two || props.paystub?.paystub?.interval_two) {
    final += ` and ${props.paystub?.interval_two || props.paystub?.paystub?.interval_two}`;
  }

  return final;
});

const shortRecurrenceText = computed(() => {
  let final =
    props.paystub?.interval_one ?? props.paystub?.paystub?.interval_one;
  final = final.charAt(0).toUpperCase() + final.slice(1);

  if (props.paystub?.interval_two || props.paystub?.paystub?.interval_two) {
    final += ` and ${props.paystub?.interval_two || props.paystub?.paystub?.interval_two}`;
  }

  return final;
});
</script>

<template>
  <div
    class="w-full bg-primary-100 hover:bg-primary-300 cursor-pointer text-black cursor-pointer hover:shadow-lg border border-gray-200 p-6 rounded-xl transition-transform transform hover:scale-105 ease-in-out"
  >
    <a :href="paystubUrl">
      <div class="flex justify-between items-center">
        <div>
          <h2
            class="text-base md:text-xl font-bold text-gray-800 flex items-center gap-2"
          >
            {{ formattedPaystub.issuer }}
            <span v-if="formattedPaystub.isDeposited">
              <PaidIcon />
            </span>
          </h2>
          <h4 class="text-md font-medium text-gray-600">
            <span class="hidden md:inline-flex">
              {{ recurrenceText }}
            </span>
            <span class="inline-flex md:hidden">
              {{ shortRecurrenceText }}
            </span>
          </h4>
        </div>

        <div class="text-right">
          <p class="text-2xl font-bold text-primary-700">
            ${{ formattedPaystub.amount }}
          </p>
          <p
            v-if="formattedPaystub.payDate"
            class="text-sm md:text-md font-medium text-gray-500"
          >
            Deposits: {{ formattedPaystub.payDate }}
          </p>
        </div>
      </div>

      <div class="mt-4 text-gray-700 text-md">
        {{ formattedPaystub.notes }}
      </div>
    </a>
  </div>
</template>
