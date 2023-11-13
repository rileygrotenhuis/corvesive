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
        <NavigationPayPeriodPopover class="flex items-center" />
      </template>
      <template #profile-menu>
        <NavigationProfileMenu />
      </template>
      <template #responsive-menu>
        <NavigationResponsiveMenu class="flex md:hidden items-center" />
      </template>
    </NavigationTopNavigationBar>
    <div class="w-11/12 max-w-[1225px] mx-auto">
      <slot />
    </div>
  </div>
</template>
