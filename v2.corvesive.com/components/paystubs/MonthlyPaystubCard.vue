<script setup lang="ts">
defineProps({
  issuer: String,
  amount: String,
});
</script>

<template>
  <div class="hover:bg-gray-800 hover:cursor-pointer">
    <UCard :ui="{ background: 'dark:bg-transparent' }">
      <div
        class="flex flex-col gap-2 sm:flex-row justify-between items-center text-center sm:text-left"
      >
        <div>
          <p class="text-xl font-bold">{{ issuer }}</p>
        </div>
        <div class="border border-rose-500 py-1 px-2 rounded-lg">
          <p class="text-xl text-rose-500 font-bold">{{ amount }}</p>
        </div>
      </div>
    </UCard>
  </div>
</template>
