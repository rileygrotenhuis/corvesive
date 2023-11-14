<script setup lang="ts">
defineProps({
  issuer: String,
  amount: String,
});
</script>

<template>
  <div
    class="hover:bg-gray-800 hover:cursor-pointer shadow-sm hover:shadow-2xl"
  >
    <UCard :ui="{ background: 'dark:bg-transparent' }">
      <div
        class="flex flex-col gap-2 sm:flex-row justify-between items-center text-center sm:text-left"
      >
        <div>
          <p class="text-xl font-bold">{{ issuer }}</p>
        </div>
        <div>
          <p class="text-xl text-rose-500 font-bold">{{ amount }}</p>
        </div>
      </div>
    </UCard>
  </div>
</template>
