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
  <h1>Budgets</h1>
</template>
