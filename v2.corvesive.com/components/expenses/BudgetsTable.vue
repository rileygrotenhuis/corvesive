<script setup lang="ts">
const accountStore = useAccountStore();
const budgetStore = useBudgetStore();
const modalStore = useModalStore();
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
    v-for="payPeriodBudget in budgetStore.payPeriodBudgets"
    :key="`${payPeriodBudget.pay_period.id} - ${payPeriodBudget.id}`"
    :title="payPeriodBudget.budget.name"
    :amount="payPeriodBudget.remaining_balance.pretty"
    :amountSubtitle="payPeriodBudget.total_balance.pretty"
    @click="modalStore.openSettingsModal('payPeriodBudget', payPeriodBudget)"
  />
</template>
