<script setup>
import { useForm } from '@inertiajs/vue3';
import PaidIcon from '@/Components/Icons/PaidIcon.vue';

const props = defineProps({
  monthlyPaystub: Object,
});

const unschedulePaystub = () => {
  if (confirm('Are you sure you want to unschedule this paystub?')) {
    useForm({}).delete(route('paystubs.unschedule', props.monthlyPaystub.id));
  }
};
</script>

<template>
  <div class="max-w-6xl mx-auto px-8 my-8">
    <div class="max-w-3xl bg-white p-6 rounded-lg">
      <div class="my-2">
        <a
          :href="route('paystubs.index')"
          class="text-primary-700 hover:font-bold"
        >
          &larr; Back to Paystubs
        </a>
      </div>

      <div class="flex justify-between">
        <a :href="route('paystubs.index', monthlyPaystub.paystub.id)">
          <h2
            class="text-2xl font-bold text-primary-700 flex items-center gap-2"
          >
            {{ monthlyPaystub.paystub.name }}
            <span v-if="monthlyPaystub.is_paid">
              <PaidIcon />
            </span>
          </h2>
          <p class="text-md font-semibold text-primary-950">
            <span v-if="monthlyPaystub?.paystub?.issuer">
              {{ monthlyPaystub.paystub.issuer }} -
            </span>
            {{ monthlyPaystub.paystub.type }}
          </p>
        </a>

        <div class="flex items-center gap-4"></div>

        <div class="text-black text-sm mt-2">
          {{ monthlyPaystub.paystub.notes }}
        </div>

        <div class="text-black text-sm font-semibold mt-2">
          Deposited on: {{ monthlyPaystub.pay_day }}
        </div>
      </div>
    </div>
  </div>
</template>
