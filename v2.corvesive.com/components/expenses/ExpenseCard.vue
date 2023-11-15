<script setup lang="ts">
defineProps({
  title: String,
  subtitle: String,
  amount: String,
  amountSubtitle: String,
});
</script>

<template>
  <div class="hover:cursor-pointer shadow-sm hover:shadow-2xl">
    <UCard>
      <div class="flex flex-row justify-between items-center">
        <div>
          <p class="font-bold">{{ title }}</p>
          <p v-if="subtitle" class="font-light text-sm">{{ subtitle }}</p>
        </div>
        <div class="min-w-[100px] text-right">
          <p>{{ amount }}</p>
          <p v-if="amountSubtitle" class="text-xs text-rose-500 font-bold">
            {{ amountSubtitle }}
          </p>
        </div>
      </div>
    </UCard>
  </div>
</template>
