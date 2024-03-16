<script setup>
defineProps({
  incomeBreakdown: Object,
});
</script>

<template>
  <div class="bg-gray-800 rounded-lg shadow-lg w-3/4 md:w-1/4">
    <h3 class="text-white text-center p-6 font-bold text-2xl mb-4">
      Income Breakdown
    </h3>
    <ul class="px-6">
      <li
        v-for="(key, index) in Object.keys(incomeBreakdown.card)"
        :key="index"
        class="flex justify-between mb-2 text-lg"
      >
        <span class="text-gray-300">{{
          incomeBreakdown.card[key].issuer
        }}</span>
        <span class="text-white">{{ incomeBreakdown.card[key].total }}</span>
      </li>
    </ul>
    <div class="bg-gray-700 p-4 rounded-b-lg">
      <h4 class="text-white font-bold">
        Total: {{ incomeBreakdown.card.total }}
      </h4>
    </div>
  </div>
</template>
