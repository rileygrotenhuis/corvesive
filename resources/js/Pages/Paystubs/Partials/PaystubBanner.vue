<script setup>
import { computed } from 'vue';
import PaidIcon from '@/Components/Icons/PaidIcon.vue';

const props = defineProps({
  paystub: Object,
});

const paystubUrl = computed(() => {
  if (props.paystub?.date) {
    return route('monthly-paystubs.show', props.paystub.id);
  }

  return route('paystubs.show', props.paystub.id);
});

const amount = computed(() => {
  return props.paystub.amount.toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});
</script>

<template>
  <div
    class="w-full bg-primary-100 hover:bg-primary-300 cursor-pointer text-black cursor-pointer hover:shadow-lg border border-gray-200 p-6 rounded-xl transition-transform transform hover:scale-105 ease-in-out"
  >
    <a :href="paystubUrl">
      <div class="flex justify-between items-center gap-1">
        <div>
          <h2
            class="text-base md:text-xl font-bold text-gray-800 flex items-center gap-2"
          >
            {{ paystub.issuer }}
            <span v-if="paystub.isDeposited">
              <PaidIcon />
            </span>
          </h2>
          <h4 class="text-sm md:text-md font-medium text-gray-600">
            {{ paystub.recurrence }}
          </h4>
        </div>

        <div class="text-right">
          <p class="text-2xl font-bold text-primary-700">
            {{ amount }}
          </p>
          <p
            v-if="paystub.date"
            class="text-sm md:text-md font-medium text-gray-500"
          >
            Deposits: {{ paystub.date }}
          </p>
        </div>
      </div>

      <div class="mt-4 text-gray-700 text-md">
        {{ paystub.notes }}
      </div>
    </a>
  </div>
</template>
