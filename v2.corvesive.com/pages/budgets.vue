<script setup lang="ts">
useHead({
  title: 'Corvesive - Budgets',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const budgetStore = useBudgetStore();
const payPeriodStore = usePayPeriodStore();

await budgetStore.getBudgets();
await budgetStore.getPayPeriodBudgets(payPeriodStore.currentPayPeriod.id);
</script>

<template>
  <div class="mt-8">
    <div class="flex flex-col gap-4">
      <BudgetsMonthlyBudgetCard
        v-for="budget in budgetStore.budgets"
        :key="budget.id.toString()"
        :name="budget.name"
        :amount="budget.amount.pretty"
      />
    </div>
  </div>
</template>
