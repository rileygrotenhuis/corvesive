<script setup>
defineProps({
  question: String,
  action: String,
  to: String
});
</script>

<template>
  <div class="text-sm">
    <p class="text-gray-600 text-center">
      {{ question }}
      <NuxtLink :to="to" class="text-blue-500 hover:text-blue-700">
        {{ action }}
      </NuxtLink>
    </p>
  </div>
</template>
