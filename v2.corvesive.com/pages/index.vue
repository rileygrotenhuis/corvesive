<script setup lang="ts">
useHead({
  title: 'Corvesive',
});

definePageMeta({
  middleware: 'auth',
});
</script>

<template>
  <h1>Home Page</h1>
</template>
