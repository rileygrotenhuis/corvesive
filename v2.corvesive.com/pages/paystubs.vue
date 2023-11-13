<script setup lang="ts">
useHead({
  title: 'Corvesive - Paystubs',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const paystubStore = usePaystubStore();
const payPeriodStore = usePayPeriodStore();

await paystubStore.getPaystubs();
await paystubStore.getPayPeriodPaystubs(payPeriodStore.currentPayPeriod.id);
</script>

<template>
  <h1>Paystubs</h1>
</template>
