<script setup lang="ts">
import MetricsIcon from '~/components/icons/MetricsIcon.vue';
import useMonthlyMetricsStore from '~/stores/monthlyMetrics.js';
import copy from '~/libs/locales/copy.js';

useHead({
  title: 'Corvesive - Budgets',
});

definePageMeta({
  layout: 'monthly',
});

await useMonthlyMetricsStore().getMonthlyMetrics();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="MetricsIcon"
      title="Metrics"
      :subtext="copy['monthly']['metrics']"
    />
    <MetricsMonthlyMetrics class="mt-8" />
  </div>
</template>
