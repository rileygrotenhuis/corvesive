<script setup lang="ts">
const accountStore = useAccountStore();
const budgetStore = useBudgetStore();
</script>

<template>
  <ExpensesExpenseCard
    v-if="accountStore.isRecurringView"
    v-for="budget in budgetStore.budgets"
    :key="budget.id.toString()"
    :title="budget.name"
    :amount="budget.amount.pretty"
  />
  <ExpensesExpenseCard
    v-else
    v-for="budget in budgetStore.payPeriodBudgets"
    :key="`${budget.pay_period.id} - ${budget.id}`"
    :title="budget.budget.name"
    :amount="budget.remaining_balance.pretty"
    :amountSubtitle="budget.total_balance.pretty"
  />
</template>
