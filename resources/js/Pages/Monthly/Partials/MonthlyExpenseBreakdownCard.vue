<script setup>
defineProps({
  monthlyExpenseBreakdown: Object,
});
</script>

<template>
  <div class="bg-gray-800 rounded-lg shadow-lg">
    <h3 class="text-white p-6 font-bold text-2xl mb-4">
      Monthly Expenses Breakdown
    </h3>
    <ul class="px-6">
      <li class="flex justify-between mb-2 text-lg">
        <span class="text-gray-300">Bills:</span>
        <span class="text-white">{{ monthlyExpenseBreakdown.card.bills }}</span>
      </li>
      <li class="flex justify-between mb-2 text-lg">
        <span class="text-gray-300">Budgets:</span>
        <span class="text-white">{{
          monthlyExpenseBreakdown.card.budgets
        }}</span>
      </li>
      <li class="flex justify-between mb-4 text-lg">
        <span class="text-gray-300">Savings:</span>
        <span class="text-white">{{
          monthlyExpenseBreakdown.card.savings
        }}</span>
      </li>
    </ul>
    <div class="bg-gray-700 p-4 rounded-b-lg">
      <h4 class="text-white font-bold">
        Total Expenses: {{ monthlyExpenseBreakdown.card.total }}
      </h4>
    </div>
  </div>
</template>
