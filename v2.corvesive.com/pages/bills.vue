<script setup lang="ts">
useHead({
  title: 'Corvesive - Bills',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const billStore = useBillStore();
const payPeriodStore = usePayPeriodStore();

await billStore.getBills();
await billStore.getPayPeriodBills(payPeriodStore.currentPayPeriod.id);
</script>

<template>
  <div class="mt-8">
    <div class="flex flex-col gap-6">
      <BillsMonthlyBillCard
        v-for="bill in billStore.bills"
        :key="bill.id.toString()"
        :issuer="bill.issuer"
        :name="bill.name"
        :dueDate="bill.due_date.pretty"
        :amount="bill.amount.pretty"
      />
    </div>
  </div>
</template>
