<script setup>
defineProps({
  remainingSavings: Array,
});
</script>

<template>
  <div class="bg-gray-800 rounded-lg shadow-lg">
    <h3 class="text-white text-center p-6 font-bold text-2xl">Due Savings</h3>
    <ul class="px-6 pb-6">
      <li
        v-for="(remainingSaving, index) in remainingSavings"
        :key="index"
        class="flex items-center justify-between mb-2 text-lg"
      >
        <div class="flex gap-1">
          <span class="text-gray-300">{{
            remainingSaving.monthly_saving.name
          }}</span>
        </div>
        <div class="flex gap-2 text-sm">
          <span class="text-white"
            >${{ remainingSaving.remaining_amount / 100 }}</span
          >
        </div>
      </li>
    </ul>
  </div>
</template>
