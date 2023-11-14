<script setup lang="ts">
defineProps({
  name: String,
  amount: String,
});
</script>

<template>
  <div
    class="hover:bg-gray-800 hover:cursor-pointer shadow-sm hover:shadow-2xl"
  >
    <UCard :ui="{ background: 'dark:bg-transparent' }">
      <div
        class="flex justify-between items-center text-center sm:text-left md:text-xl"
      >
        <div>
          <p class="font-bold">{{ name }}</p>
        </div>
        <div>
          <p class="text-rose-500 font-bold">{{ amount }}</p>
        </div>
      </div>
    </UCard>
  </div>
</template>
