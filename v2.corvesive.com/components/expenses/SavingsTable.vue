<script setup lang="ts">
const accountStore = useAccountStore();
const savingStore = useSavingStore();
</script>

<template>
  <ExpensesExpenseCard
    v-if="accountStore.isRecurringView"
    v-for="saving in savingStore.savings"
    :key="saving.id.toString()"
    :title="saving.name"
    :amount="saving.amount.pretty"
  />
  <ExpensesExpenseCard
    v-else
    v-for="saving in savingStore.payPeriodSavings"
    :key="`${saving.pay_period.id} - ${saving.id}`"
    :title="saving.saving_account.name"
    :amount="saving.amount.pretty"
  />
</template>
