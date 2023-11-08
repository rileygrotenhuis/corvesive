<script setup lang="ts">
import PaystubsIcon from '~/components/icons/PaystubsIcon.vue';
import copy from '~/libs/locales/copy.js';
import usePayPeriodPaystubsStore from '~/stores/payPeriodPaystubs.js';

useHead({
  title: 'Corvesive - Pay Period Income',
});

definePageMeta({
  layout: 'dashboard',
});

await usePayPeriodPaystubsStore().getPayPeriodPaystubs();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="PaystubsIcon"
      title="Paystubs"
      :subtext="copy['payPeriod']['paystubs']"
      buttonColor="bg-red-500"
      modalKey="payPeriods.paystubs.attach"
    />
  </div>
  <PaystubsPayPeriodPaystubsTable class="mt-8" />
</template>
