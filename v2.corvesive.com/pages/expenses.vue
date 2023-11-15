<script setup lang="ts">
useHead({
  title: 'Corvesive - Expenses',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const billStore = useBillStore();
const budgetStore = useBudgetStore();

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
  <div class="mt-8">
    <UTabs :items="tabs" class="w-full">
      <template #item="{ item }">
        <UCard>
          <div class="flex flex-col gap-4">
            <ExpensesExpenseCard
              v-if="item.key === 'bills'"
              v-for="bill in billStore.bills"
              :key="bill.id.toString()"
              :title="bill.issuer"
              :subtitle="bill.name"
              :amount="bill.amount.pretty"
              :amountSubtitle="bill.due_date.pretty"
            />
            <ExpensesExpenseCard
              v-else-if="item.key === 'budgets'"
              v-for="budget in budgetStore.budgets"
              :key="budget.id.toString()"
              :title="budget.name"
              :amount="budget.amount.pretty"
            />
          </div>
        </UCard>
      </template>
    </UTabs>
  </div>
</template>
