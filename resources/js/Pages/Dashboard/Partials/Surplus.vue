<script setup>
import { computed } from 'vue';

const props = defineProps({
  surplus: Object,
});

const currentSurplus = computed(() => {
  return (props.surplus.current / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});
</script>

<template>
  <div class="w-full bg-white p-4 rounded-md text-black">
    <h3 class="text-xl font-semibold text-black mb-2">Spending</h3>

    <div class="mb-2">
      <label class="text-base text-gray-500">Current</label>
      <p class="text-2xl font-semibold text-primary-700">
        {{ currentSurplus }}
      </p>
    </div>
  </div>
</template>
