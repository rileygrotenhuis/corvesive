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
  <h1>Bills</h1>
</template>
