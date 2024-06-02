<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Transactions from '@/Pages/Dashboard/Partials/Transactions.vue';
import Metrics from '@/Pages/Dashboard/Partials/Metrics.vue';

defineProps({
  transactions: Array,
  expenses: Object,
  paystubs: Object,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <div class="flex flex-col-reverse md:flex-row gap-4 items-start">
        <Transactions :transactions="transactions" />
        <Metrics :expenses="expenses" :paystubs="paystubs" />
      </div>
    </div>
  </MainLayout>
</template>
