<script setup>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, watch } from 'vue';

const user = usePage().props.auth.user;
const payPeriods = usePage().props.auth.payPeriods;
const userHasPayPeriod = Boolean(usePage().props.auth.user.current_pay_period);

const currentPayPeriod = ref(user.current_pay_period?.id ?? null);

watch(currentPayPeriod, (newValue, oldValue) => {
  useForm({}).put(route('pay-periods.current', newValue));
});
</script>

<template>
  <div
    class="flex flex-col md:flex-row justify-center sm:justify-between items-center"
  >
    <div
      class="flex flex-col md:flex-row justify-center md:justify-start items-center gap-4 md:gap-16"
    >
      <Link
        :href="route('pay-periods.index')"
        class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
      >
        Pay Periods
      </Link>
      <ul
        v-if="userHasPayPeriod"
        class="flex justify-center items-center gap-8"
      >
        <li>
          <Link
            :href="route('pay-period-paystubs.index')"
            class="font-semibold text-gray-400 leading-tight"
          >
            Paystubs
          </Link>
        </li>
        <li>
          <Link
            :href="route('pay-period-bills.index')"
            class="font-semibold text-gray-400 leading-tight"
          >
            Bills
          </Link>
        </li>
        <li>
          <Link
            :href="route('pay-period-budgets.index')"
            class="font-semibold text-gray-400 leading-tight"
          >
            Budgets
          </Link>
        </li>
        <li>
          <Link
            :href="route('pay-period-savings.index')"
            class="font-semibold text-gray-400 leading-tight"
          >
            Savings
          </Link>
        </li>
      </ul>
    </div>
    <div class="flex gap-8 items-center pt-4 md:pt-0">
      <select
        v-if="payPeriods.length > 0"
        v-model="currentPayPeriod"
        class="border-gray-700 bg-zinc-900 text-white focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm"
      >
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
