<script setup lang="ts">
const accountStore = useAccountStore();
const savingStore = useSavingStore();
const modalStore = useModalStore();
</script>

<template>
  <ExpensesExpenseCard
    v-if="accountStore.isRecurringView"
    v-for="saving in savingStore.savings"
    :key="saving.id.toString()"
    :title="saving.name"
    :amount="saving.amount.pretty"
    @click="modalStore.openSettingsModal('saving', saving)"
  />
  <ExpensesExpenseCard
    v-else
    v-for="payPeriodSaving in savingStore.payPeriodSavings"
    :key="`${payPeriodSaving.pay_period.id} - ${payPeriodSaving.id}`"
    :title="payPeriodSaving.saving_account.name"
    :amount="payPeriodSaving.amount.pretty"
    @click="modalStore.openSettingsModal('payPeriodSaving', payPeriodSaving)"
  />
</template>
