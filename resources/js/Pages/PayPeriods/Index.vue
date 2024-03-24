<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import PayPeriodSurplusCard from '@/Pages/PayPeriods/Partials/PayPeriodSurplusCard.vue';
import DueBills from '@/Pages/PayPeriods/Partials/DueBills.vue';
import RemainingBudgets from '@/Pages/PayPeriods/Partials/RemainingBudgets.vue';
import RemainingSavings from '@/Pages/PayPeriods/Partials/RemainingSavings.vue';

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
      <div
        class="max-w-7xl mx-auto flex flex-wrap gap-8 justify-center items-start"
      >
        <PayPeriodSurplusCard
          class="w-full sm:w-1/4"
          :totalIncome="totalIncome"
          :totalExpenses="totalExpenses"
          :actualSurplus="actualSurplus"
          :projectedSurplus="projectedSurplus"
        />
        <DueBills
          class="w-full sm:w-1/4"
          v-if="dueBills.length > 0"
          :dueBills="dueBills"
        />
        <RemainingBudgets
          class="w-full sm:w-1/4"
          v-if="remainingBudgets.length > 0"
          :remainingBudgets="remainingBudgets"
        />
        <RemainingSavings
          class="w-full sm:w-1/4"
          v-if="remainingSavings.length > 0"
          :remainingSavings="remainingSavings"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
