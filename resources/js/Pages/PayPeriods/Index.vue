<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';

defineProps({
  totalIncome: Number,
  totalExpenses: Number,
  dueBills: Array,
  remainingBudgets: Array,
  remainingSavings: Array,
  actualSurplus: Number,
  projectedSurplus: Number,
});

/**
 * TODO: Module #1
 *
 * - Total Income
 * - Total Expenses
 * - Current Surplus
 * - Projected Surplus
 */

/**
 * TODO: Module #2
 * Due Bills
 */

/**
 * TODO: Module #3
 * Remaining Budgets
 */

/**
 * TODO: Module #4
 * Remaining Savings
 */
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <PayPeriodsHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1>Content will go here</h1>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
