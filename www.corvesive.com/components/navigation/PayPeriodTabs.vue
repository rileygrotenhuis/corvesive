<script setup lang="ts">
const tabs = [
  {
    url: '/dashboard',
    text: 'Dashboard',
  },
  {
    url: '/dashboard/paystubs',
    text: 'Paystubs',
  },
  {
    url: '/dashboard/bills',
    text: 'Bills',
  },
  {
    url: '/dashboard/budgets',
    text: 'Budgets',
  },
  {
    url: '/dashboard/metrics',
    text: 'Metrics',
  },
  {
    url: '/dashboard/transactions',
    text: 'Transactions',
  },
];
</script>

<template>
  <NavigationTabs :tabs="tabs" />
</template>
