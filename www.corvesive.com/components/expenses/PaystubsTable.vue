<script setup lang="ts">
const accountStore = useAccountStore();
const paystubStore = usePaystubStore();
const modalStore = useModalStore();
</script>

<template>
  <ExpensesExpenseCard
    v-if="accountStore.isRecurringView"
    v-for="paystub in paystubStore.paystubs"
    :key="paystub.id.toString()"
    :title="paystub.issuer"
    :subtitle="paystub.type"
    :amount="paystub.amount.pretty"
    @click="modalStore.openSettingsModal('paystub', paystub)"
  />
  <ExpensesExpenseCard
    v-else
    v-for="payPeriodPaystub in paystubStore.payPeriodPaystubs"
    :key="`${payPeriodPaystub.pay_period.id} - ${payPeriodPaystub.id}`"
    :title="payPeriodPaystub.paystub.issuer"
    :subtitle="payPeriodPaystub.paystub.type"
    :amount="payPeriodPaystub.amount.pretty"
    @click="modalStore.openSettingsModal('payPeriodPaystub', payPeriodPaystub)"
  />
</template>
