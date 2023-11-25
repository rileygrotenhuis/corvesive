<script setup lang="ts">
defineProps({
  title: String,
  subtitle: String,
  amount: String,
  amountSubtitle: String,
  hasPayed: Boolean,
});
</script>

<template>
  <div class="hover:cursor-pointer shadow-sm hover:shadow-2xl">
    <UCard>
      <div class="flex flex-row justify-between items-center">
        <div>
          <div class="flex gap-1 items-center">
            <p class="font-bold">{{ title }}</p>
            <UIcon
              v-if="hasPayed"
              name="i-heroicons-check-circle"
              class="w-5 h-5 text-green-500"
            />
          </div>
          <p v-if="subtitle" class="font-light text-sm">{{ subtitle }}</p>
        </div>
        <div class="min-w-[100px] text-right">
          <p>{{ amount }}</p>
          <p v-if="amountSubtitle" class="text-xs text-fuchsia-500 font-bold">
            {{ amountSubtitle }}
          </p>
        </div>
      </div>
    </UCard>
  </div>
</template>
