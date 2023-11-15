<script setup lang="ts">
useHead({
  title: 'Corvesive - Expenses',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const paystubStore = usePaystubStore();

await paystubStore.getPaystubs();
await useBudgetStore().getBudgets();

const tabs = [
  {
    key: 'paystubs',
    label: 'Paystubs',
  },
  {
    key: 'deposits',
    label: 'Deposits',
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
              v-if="item.key === 'paystubs'"
              v-for="paystub in paystubStore.paystubs"
              :key="paystub.id.toString()"
              :title="paystub.issuer"
              :subtitle="paystub.type"
              :amount="paystub.amount.pretty"
            />
            <ExpensesExpenseCard
              v-else-if="item.key === 'deposits'"
              v-for="budget in useBudgetStore().budgets"
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
