<script setup lang="ts">
const data = await useNuxtApp().$api.paystubs.getPaystubs();
</script>

<template>
  <h1>Corvesive</h1>
</template>
