<script setup>
defineProps({
  bill: Object,
});
</script>

<template>
  <div
    class="flex h-auto w-40 flex-col rounded-md border border-black p-4 text-center shadow-lg hover:cursor-pointer"
  >
    <span class="text-2xl font-bold">{{ bill.name }}</span>
    <span class="text-lg font-extralight"
      >${{ (bill.amount / 100).toFixed(2) }}</span
    >
  </div>
</template>
