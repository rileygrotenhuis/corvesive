<script setup lang="ts">
import type { PageTabs } from '~/types/PageTabs';

const tabs: PageTabs[] = [
  {
    url: '/monthly',
    text: 'Metrics',
  },
  {
    url: '/monthly/paystubs',
    text: 'Paystubs',
  },
  {
    url: '/monthly/bills',
    text: 'Bills',
  },
  {
    url: '/monthly/budgets',
    text: 'Budgets',
  },
];
</script>

<template>
  <NavigationTabs :tabs="tabs" />
</template>
