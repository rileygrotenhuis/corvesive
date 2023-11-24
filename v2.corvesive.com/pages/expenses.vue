<script setup lang="ts">
useHead({
  title: 'Corvesive - Expenses',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const accountStore = useAccountStore();
const billStore = useBillStore();
const budgetStore = useBudgetStore();

await billStore.getPayPeriodBills(accountStore.user.pay_period.id);
await budgetStore.getPayPeriodBudgets(accountStore.user.pay_period.id);
await billStore.getBills();
await budgetStore.getBudgets();

const tabs = [
  {
    key: 'bills',
    label: 'Bills',
  },
  {
    key: 'budgets',
    label: 'Budgets',
  },
];
</script>

<template>
  <div>
    <UTabs :items="tabs" class="w-full">
      <template #item="{ item }">
        <UCard>
          <div class="flex flex-col gap-4">
            <ExpensesBillsTable v-if="item.key === 'bills'" />
            <ExpensesBudgetsTable v-if="item.key === 'budgets'" />
          </div>
        </UCard>
      </template>
    </UTabs>
  </div>
</template>
