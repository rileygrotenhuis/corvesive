<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Transactions from '@/Pages/Dashboard/Partials/Transactions.vue';
import Metrics from '@/Pages/Dashboard/Partials/Metrics.vue';
import Surplus from '@/Pages/Dashboard/Partials/Surplus.vue';

defineProps({
  transactions: Array,
  expenses: Object,
  paystubs: Object,
  surplus: Object,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <div class="flex flex-col-reverse md:flex-row gap-4 items-start">
        <Transactions :transactions="transactions" />
        <div
          class="w-full md:w-1/3 gap-4 flex flex-col xs:flex-row-reverse md:flex-col items-start"
        >
          <Surplus :surplus="surplus" />
          <Metrics :expenses="expenses" :paystubs="paystubs" />
        </div>
      </div>
    </div>
  </MainLayout>
</template>
