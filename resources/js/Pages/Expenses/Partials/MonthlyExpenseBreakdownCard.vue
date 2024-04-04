<script setup>
defineProps({
  data: Object,
});
</script>

<template>
  <div class="bg-black rounded-lg shadow-lg w-3/4 md:w-1/4">
    <h3 class="text-white text-center p-6 font-bold text-2xl">
      Expense Breakdown
    </h3>
    <ul class="px-6">
      <li class="flex justify-between mb-2 text-lg">
        <span class="text-gray-300">Bills:</span>
        <span class="text-white">{{ data.bills }}</span>
      </li>
      <li class="flex justify-between mb-2 text-lg">
        <span class="text-gray-300">Budgets:</span>
        <span class="text-white">{{ data.budgets }}</span>
      </li>
      <li class="flex justify-between mb-4 text-lg">
        <span class="text-gray-300">Savings:</span>
        <span class="text-white">{{ data.savings }}</span>
      </li>
    </ul>
    <div class="bg-zinc-700 p-4 rounded-b-lg">
      <h4 class="text-white font-bold">
        Total: <span class="float-right">{{ data.total }}</span>
      </h4>
    </div>
  </div>
</template>
