<script setup>
defineProps({
  dueBills: Array,
});
</script>

<template>
  <div class="bg-black rounded-lg shadow-lg">
    <h3 class="text-white text-center p-6 font-bold text-2xl">Due Bills</h3>
    <ul class="px-6">
      <li
        v-for="(dueBill, index) in dueBills"
        :key="index"
        class="flex justify-between mb-2 text-lg"
      >
        <span class="text-gray-300">{{ dueBill.bill.name }}:</span>
        <span class="text-white">${{ dueBill.remaining_amount / 100 }}</span>
      </li>
    </ul>
  </div>
</template>
