<script setup lang="ts">
useHead({
  htmlAttrs: {
    lang: 'en',
  },
});
</script>

<template>
  <div>
    <NavigationNavbar />
    <div class="w-11/12 max-w-[1000px] mx-auto">
      <slot />
    </div>
  </div>
</template>
