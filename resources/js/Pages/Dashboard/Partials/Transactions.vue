<script setup>
import PaymentBanner from '@/Components/Transactions/PaymentBanner.vue';
import DepositBanner from '@/Components/Transactions/DepositBanner.vue';
import NewTransaction from '@/Pages/Dashboard/Partials/NewTransaction.vue';

defineProps({
  transactions: Array,
});
</script>

<template>
  <div class="w-full md:w-2/3 bg-white p-6 rounded-lg">
    <div class="flex justify-between items-center">
      <h2 class="text-2xl font-bold text-primary-700">Transactions</h2>

      <NewTransaction />
    </div>

    <div
      class="space-y-4 mt-4 max-h-[450px] md:max-h-[750px] overflow-y-auto no-scrollbar"
    >
      <component
        :is="transaction.deposit_day ? DepositBanner : PaymentBanner"
        v-for="(transaction, index) in transactions"
        :key="index"
        :transaction="transaction"
        showType
      />
    </div>
  </div>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}

.no-scrollbar {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
</style>
