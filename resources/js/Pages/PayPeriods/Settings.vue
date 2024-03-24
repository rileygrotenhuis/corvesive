<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import PayPeriodBills from '@/Pages/PayPeriods/Partials/PayPeriodBills.vue';
import PayPeriodBudgets from '@/Pages/PayPeriods/Partials/PayPeriodBudgets.vue';
import PayPeriodSavings from '@/Pages/PayPeriods/Partials/PayPeriodSavings.vue';
import PayPeriodPaystubs from '@/Pages/PayPeriods/Partials/PayPeriodPaystubs.vue';

defineProps({
  paystubs: Array,
  bills: Array,
  budgets: Array,
  savings: Array,
});
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <PayPeriodsHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <PayPeriodPaystubs :paystubs="paystubs" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <PayPeriodBills :bills="bills" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <PayPeriodBudgets :budgets="budgets" />
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <PayPeriodSavings :savings="savings" />
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
