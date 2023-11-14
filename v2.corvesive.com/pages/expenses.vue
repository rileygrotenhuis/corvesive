<script setup lang="ts">
useHead({
  title: 'Corvesive - Expenses',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});
</script>

<template>
  <div class="mt-8">
    <h1>Expenses</h1>
  </div>
</template>
