<script setup lang="ts">
useHead({
  title: 'Corvesive',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});
</script>

<template>
  <div class="mt-8">
    <h1>Dashboard</h1>
  </div>
</template>
