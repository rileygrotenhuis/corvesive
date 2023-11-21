<script setup lang="ts">
const accountStore = useAccountStore();
const billStore = useBillStore();
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
        v-for="bill in billStore.payPeriodBills"
        :key="`${bill.pay_period.id} - ${bill.id}`"
        :title="bill.bill.issuer"
        :subtitle="bill.bill.name"
        :amount="bill.amount.pretty"
        :amountSubtitle="bill.dates.due.pretty.short"
        :hasPayed="Boolean(bill.has_payed)"
    />
</template>