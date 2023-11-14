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
  <div class="mt-8">
    <div class="flex flex-col gap-4">
      <PaystubsMonthlyPaystubCard
        v-for="paystub in paystubStore.paystubs"
        :key="paystub.id.toString()"
        :issuer="paystub.issuer"
        :amount="paystub.amount.pretty"
      />
    </div>
  </div>
</template>
