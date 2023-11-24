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
  <div>
    <h1>Dashboard</h1>
    <UButton @click="useModalStore().openTransactionsModal('bill')"
      >Test</UButton
    >
  </div>
</template>
