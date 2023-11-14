<script setup lang="ts">
import { stringLiteral } from '@babel/types';

defineProps({
  issuer: String,
  name: String,
  dueDate: String,
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
          <p>
            {{ name }}
            <span class="hidden md:inline font-light text-rose-500"
              >({{ dueDate }})</span
            >
          </p>
        </div>
        <div class="border border-rose-500 py-1 px-2 rounded-lg">
          <p class="text-2xl text-rose-500 font-bold">{{ amount }}</p>
        </div>
      </div>
    </UCard>
  </div>
</template>
