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
    <BillsBillTableCell
      issuer="City Utilities"
      name="Electricity Bill"
      dueDate="11/12/2023"
      amount="$1,122"
    />
  </div>
</template>
