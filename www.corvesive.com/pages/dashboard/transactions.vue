<script setup>
import useTransactionsStore from '~/stores/transactions.js';
import PaymentIcon from '~/components/icons/PaymentIcon.vue';
import copy from '~/libs/locales/copy.js';

useHead({
  title: 'Corvesive - Pay Period Transactions'
});

definePageMeta({
  layout: 'dashboard'
});

await useTransactionsStore().getPayPeriodTransactions();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="PaymentIcon"
      title="Transactions"
      :subtext="copy['payPeriod']['transactions']"
    />
  </div>
  <TransactionsTable class="mt-8" />
</template>
