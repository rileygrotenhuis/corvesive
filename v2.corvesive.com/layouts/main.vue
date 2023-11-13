<script setup lang="ts">
useHead({
  htmlAttrs: {
    lang: 'en',
  },
});
</script>

<template>
  <div>
    <NavigationTopNavigationBar>
      <template #pay-period-select>
        <NavigationPayPeriodSelection />
      </template>
      <template #profile-menu>
        <NavigationProfileMenu />
      </template>
    </NavigationTopNavigationBar>
    <div class="w-11/12 max-w-[1225px] mx-auto">
      <slot />
    </div>
  </div>
</template>
