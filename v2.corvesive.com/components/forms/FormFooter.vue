<script setup lang="ts">
defineProps({
  question: String,
  action: String,
  to: String,
});
</script>

<template>
  <p class="text-gray-200 text-center mt-4">
    {{ question }}
    <ULink class="text-primary hover:underline" :to="to">{{ action }}</ULink>
  </p>
</template>
