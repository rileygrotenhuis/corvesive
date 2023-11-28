<script setup lang="ts">
useHead({
  title: 'Corvesive',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const accountStore = useAccountStore();
const payPeriodsStore = usePayPeriodStore();

await payPeriodsStore.getPayPeriodMetrics(accountStore.user.pay_period.id);
</script>

<template>
  <div>
    <h1>Dashboard</h1>
  </div>
</template>
