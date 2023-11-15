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
  <div class="mt-8">
    <UTabs :items="tabs" class="w-full">
      <template #item="{ item }">
        <UCard>
          <div class="flex flex-col gap-4">
            <ExpensesExpenseCard
              v-if="accountStore.isRecurringView && item.key === 'bills'"
              v-for="bill in billStore.bills"
              :key="bill.id.toString()"
              :title="bill.issuer"
              :subtitle="bill.name"
              :amount="bill.amount.pretty"
              :amountSubtitle="bill.due_date.pretty"
            />
            <ExpensesExpenseCard
              v-else-if="!accountStore.isRecurringView && item.key === 'bills'"
              v-for="bill in billStore.payPeriodBills"
              :key="`${bill.pay_period.id} - ${bill.id}`"
              :title="bill.bill.issuer"
              :subtitle="bill.bill.name"
              :amount="bill.amount.pretty"
              :amountSubtitle="bill.dates.due.pretty.day"
            />
            <ExpensesExpenseCard
              v-else-if="accountStore.isRecurringView && item.key === 'budgets'"
              v-for="budget in budgetStore.budgets"
              :key="budget.id.toString()"
              :title="budget.name"
              :amount="budget.amount.pretty"
            />
            <ExpensesExpenseCard
              v-else-if="
                !accountStore.isRecurringView && item.key === 'budgets'
              "
              v-for="budget in budgetStore.payPeriodBudgets"
              :key="`${budget.pay_period.id} - ${budget.id}`"
              :title="budget.budget.name"
              :amount="budget.total_balance.pretty"
              :amountSubtitle="budget.remaining_balance.pretty"
            />
          </div>
        </UCard>
      </template>
    </UTabs>
  </div>
</template>
