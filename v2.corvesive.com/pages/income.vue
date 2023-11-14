<script setup lang="ts">
useHead({
  title: 'Corvesive - Income',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});
</script>

<template>
  <div class="mt-8">
    <h1>Income</h1>
  </div>
</template>
