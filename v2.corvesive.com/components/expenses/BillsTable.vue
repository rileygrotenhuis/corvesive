<script setup lang="ts">
const accountStore = useAccountStore();
const billStore = useBillStore();
const modalStore = useModalStore();
</script>

<template>
  <ExpensesExpenseCard
    v-if="accountStore.isRecurringView"
    v-for="bill in billStore.bills"
    :key="bill.id.toString()"
    :title="bill.issuer"
    :subtitle="bill.name"
    :amount="bill.amount.pretty"
    :amountSubtitle="bill.due_date.pretty"
  />
  <ExpensesExpenseCard
    v-else
    v-for="payPeriodBill in billStore.payPeriodBills"
    :key="`${payPeriodBill.pay_period.id} - ${payPeriodBill.id}`"
    :title="payPeriodBill.bill.issuer"
    :subtitle="payPeriodBill.bill.name"
    :amount="payPeriodBill.amount.pretty"
    :amountSubtitle="payPeriodBill.dates.due.pretty.short"
    :hasPayed="Boolean(payPeriodBill.has_payed)"
    @click="modalStore.openSettingsModal('payPeriodBill', payPeriodBill)"
  />
</template>
