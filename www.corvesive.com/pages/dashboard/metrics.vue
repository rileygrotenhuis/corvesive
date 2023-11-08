<script setup lang="ts">
import usePayPeriodMetricsStore from '~/stores/payPeriodMetrics.js';
import MetricsIcon from '~/components/icons/MetricsIcon.vue';
import copy from '~/libs/locales/copy.ts';

useHead({
  title: 'Corvesive - Pay Period Dashboard',
});

definePageMeta({
  layout: 'dashboard',
});

await usePayPeriodMetricsStore().getPayPeriodMetrics();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="MetricsIcon"
      title="Metrics"
      :subtext="copy['payPeriod']['metrics']"
    />
    <MetricsPayPeriodMetrics class="mt-8" />
  </div>
</template>
