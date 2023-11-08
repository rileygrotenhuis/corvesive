<script setup lang="ts">
defineProps({
  message: String,
});
</script>

<template>
  <div class="p-4">
    {{ message }}
  </div>
</template>
