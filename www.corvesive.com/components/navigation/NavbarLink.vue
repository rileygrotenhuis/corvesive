<script setup>
defineProps({
  to: String,
  text: String
});
</script>

<template>
  <NuxtLink :to="to" class="text-white font-light text-sm hover:text-slate-200 hover:shadow-xl">
    {{ text }}
  </NuxtLink>
</template>
