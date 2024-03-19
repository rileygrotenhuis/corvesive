<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const user = usePage().props.auth.user;
const payPeriods = usePage().props.auth.payPeriods;

const currentPayPeriod = ref(user.current_pay_period.id);

watch(currentPayPeriod, (newValue, oldValue) => {
  useForm({}).put(route('pay-periods.current', newValue));
});

console.log(user.current_pay_period);
console.log(payPeriods);
</script>

<template>
  <div
    class="flex flex-col md:flex-row gap-8 justify-center sm:justify-between items-center"
  >
    <Link
      :href="route('pay-periods.index')"
      class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
    >
      Pay Periods
    </Link>
    <div class="flex gap-16 items-center">
      <select v-model="currentPayPeriod">
        <option
          v-for="(payPeriod, index) in payPeriods"
          :key="index"
          :value="payPeriod.id"
        >
          {{ new Date(payPeriod.start_date).toLocaleDateString() }} -
          {{ new Date(payPeriod.end_date).toLocaleDateString() }}
        </option>
      </select>
      <Link
        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
        :href="route('pay-periods.create')"
      >
        + New
      </Link>
    </div>
  </div>
</template>
