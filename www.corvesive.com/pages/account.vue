<script setup lang="ts">
useHead({
  title: 'Corvesive - Account',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

await useAccountStore().me();
</script>

<template>
  <div>
    <h3 class="text-xl font-bold">Account Details</h3>
    <UDivider class="mt-2 mb-2" />
    <AuthUpdateAccountForm />
  </div>
</template>
