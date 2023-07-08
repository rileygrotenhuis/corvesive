<script setup>
import useBudgetsStore from '@/store/budgets';

const budgetsStore = useBudgetsStore();

defineProps({
  budget: Object,
});
</script>

<template>
  <div
    class="flex h-auto w-40 flex-col rounded-md border border-black p-4 text-center shadow-lg hover:cursor-pointer"
    @click="budgetsStore.setBudgetPaymentFormOpen(true, budget)"
  >
    <span class="text-2xl font-bold">{{ budget.name }}</span>
    <span class="text-lg font-extralight"
      >${{ (budget.amount / 100).toFixed(2) }}</span
    >
    <span v-if="budget.show_daily_amount" class="text-sm font-extralight"
      >(~${{ (budget.average_daily_amount / 100).toFixed(2) }}/day)</span
    >
  </div>
</template>
