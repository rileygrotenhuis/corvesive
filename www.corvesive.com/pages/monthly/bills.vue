<script setup>
import BillsIcon from '~/components/icons/BillsIcon.vue';
import useBillsStore from '~/stores/bills.js';
import copy from '~/libs/locales/copy.js';

useHead({
  title: 'Corvesive - Bills',
});

definePageMeta({
  layout: 'monthly',
});

await useBillsStore().getBills();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="BillsIcon"
      title="Bills"
      :subtext="copy['monthly']['bills']"
      buttonColor="bg-green-500"
      modalKey="bills.create"
    />
    <BillsMonthlyBillsTable class="mt-8 mb-4" />
  </div>
</template>
