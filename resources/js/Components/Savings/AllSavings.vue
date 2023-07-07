<script setup>
defineProps({
  savings: Object,
});
</script>
<template>
  <ul class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="saving in savings" :key="saving.id">
      <div
        class="flex h-auto w-40 flex-col rounded-md border border-black p-4 text-center shadow-lg hover:cursor-pointer"
      >
        <span class="text-2xl font-bold">{{ saving.name }}</span>
        <span class="text-lg font-extralight"
          >${{ (saving.amount / 100).toFixed(2) }}</span
        >
      </div>
    </li>
  </ul>
</template>
