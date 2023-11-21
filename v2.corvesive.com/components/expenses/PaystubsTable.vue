<script setup lang="ts">
const accountStore = useAccountStore();
const paystubStore = usePaystubStore();
</script>

<template>
  <ExpensesExpenseCard
    v-if="accountStore.isRecurringView"
    v-for="paystub in paystubStore.paystubs"
    :key="paystub.id.toString()"
    :title="paystub.issuer"
    :subtitle="paystub.type"
    :amount="paystub.amount.pretty"
  />
  <ExpensesExpenseCard
    v-else
    v-for="paystub in paystubStore.payPeriodPaystubs"
    :key="`${paystub.pay_period.id} - ${paystub.id}`"
    :title="paystub.paystub.issuer"
    :subtitle="paystub.paystub.type"
    :amount="paystub.amount.pretty"
  />
</template>
