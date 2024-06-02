<script setup>
import PaymentBanner from '@/Components/Transactions/PaymentBanner.vue';
import DepositBanner from '@/Components/Transactions/DepositBanner.vue';

defineProps({
  transactions: Array,
});
</script>

<template>
  <div class="max-w-3xl bg-white p-6 rounded-lg">
    <h2 class="text-2xl font-bold text-primary-700">Transactions</h2>

    <div class="space-y-4 mt-4">
      <component
        :is="transaction.deposit_day ? DepositBanner : PaymentBanner"
        v-for="transaction in transactions"
        :key="transaction.id"
        :transaction="transaction"
        showType
      />
    </div>
  </div>
</template>
