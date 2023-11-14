<script setup lang="ts">
defineProps({
  issuer: String,
  name: String,
  dueDate: String,
  amount: String,
});
</script>

<template>
  <div
    class="hover:bg-gray-800 hover:cursor-pointer shadow-sm hover:shadow-2xl"
  >
    <UCard :ui="{ background: 'dark:bg-transparent' }">
      <div class="flex justify-between items-center md:text-xl">
        <div>
          <p class="font-bold">{{ issuer }}</p>
          <p class="flex flex-col sm:flex-row gap-1">
            <span class="font-light">{{ name }}</span>
            <span class="hidden sm:inline-block">-</span>
            <span class="text-rose-500 flex items-center gap-1">
              <UIcon name="i-heroicons-calendar" class="w-4 h-4" />
              {{ dueDate }}
            </span>
          </p>
        </div>
        <div>
          <p class="text-rose-500 font-bold">{{ amount }}</p>
        </div>
      </div>
    </UCard>
  </div>
</template>
