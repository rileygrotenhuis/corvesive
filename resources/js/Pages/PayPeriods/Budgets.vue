<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import PayPeriodBudgetForm from '@/Pages/PayPeriods/Partials/PayPeriodBudgetForm.vue';

const props = defineProps({
  budgets: Array,
  currentBudgets: Array,
});

const getCurrentBudget = (budgetId) => {
  return props.currentBudgets.find((budget) => budget.id === budgetId);
};
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <PayPeriodsHeader />
    </template>

    <div class="py-12">
      <div class="space-y-6">
        <PayPeriodBudgetForm
          v-for="(budget, index) in budgets"
          :key="index"
          :budget="budget"
          :currentBudget="getCurrentBudget(budget.id)"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
