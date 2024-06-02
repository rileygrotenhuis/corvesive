<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import Transactions from '@/Pages/Dashboard/Partials/Transactions.vue';

defineProps({
  transactions: Array,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <Transactions :transactions="transactions" />
    </div>
  </MainLayout>
</template>
