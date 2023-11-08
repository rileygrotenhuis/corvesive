<script setup>
import usePaystubsStore from '~/stores/paystubs.js';
import PaystubsIcon from '~/components/icons/PaystubsIcon.vue';
import copy from '~/libs/locales/copy.js';

useHead({
  title: 'Corvesive - Budgets'
});

definePageMeta({
  layout: 'monthly'
});

await usePaystubsStore().getPaystubs();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="PaystubsIcon"
      title="Paystubs"
      :subtext="copy['monthly']['paystubs']"
      buttonColor="bg-red-500"
      modalKey="paystubs.create"
    />
    <PaystubsMonthlyPaystubsTable class="mt-8 mb-4" />
  </div>
</template>
