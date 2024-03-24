<script setup>
defineProps({
  totalIncome: Number,
  totalExpenses: Number,
  actualSurplus: Number,
  projectedSurplus: Number,
});
</script>

<template>
  <div class="bg-gray-800 rounded-lg shadow-lg w-3/4 md:w-1/4">
    <h3 class="text-white text-center p-6 font-bold text-2xl">
      Surplus Report
    </h3>
    <ul class="px-6">
      <li class="flex justify-between mb-2 text-lg">
        <span class="text-gray-300">Total Income:</span>
        <span class="text-white">${{ totalIncome / 100 }}</span>
      </li>
      <li class="flex justify-between mb-2 text-lg">
        <span class="text-gray-300">Total Expenses:</span>
        <span class="text-white">${{ totalExpenses / 100 }}</span>
      </li>
      <li class="flex justify-between mb-2 text-lg">
        <span class="text-gray-300">Current Surplus:</span>
        <span class="text-white">${{ actualSurplus / 100 }}</span>
      </li>
    </ul>
    <div class="bg-gray-700 p-4 rounded-b-lg">
      <h4 class="text-white font-bold">
        Projected Surplus:
        <span class="float-right">${{ projectedSurplus / 100 }}</span>
      </h4>
    </div>
  </div>
</template>
