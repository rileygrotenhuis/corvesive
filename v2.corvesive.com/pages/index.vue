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
  <h1>Home Page</h1>
</template>
