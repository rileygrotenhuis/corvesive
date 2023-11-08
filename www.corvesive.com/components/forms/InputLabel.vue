<script setup>
defineProps({
  resource: String,
  text: String,
});
</script>

<template>
  <label :for="resource" class="block text-gray-700 text-sm font-bold mb-2">
    {{ text }}
  </label>
</template>
