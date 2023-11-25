<script setup lang="ts">
defineProps({
  title: String,
  subtitle: String,
});
</script>

<template>
  <UCard class="max-w-md">
    <h3 class="text-center text-2xl font-bold">{{ title }}</h3>
    <h3 class="text-center text-2xl font-bold text-fuchsia-500">
      {{ subtitle }}
    </h3>
    <slot />
  </UCard>
</template>
