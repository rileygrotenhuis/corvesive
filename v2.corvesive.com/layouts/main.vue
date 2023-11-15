<script setup lang="ts">
useHead({
  htmlAttrs: {
    lang: 'en',
  },
});
</script>

<template>
  <div>
    <NavigationWrapper>
      <template #pay-period-popover>
        <NavigationPayPeriodPopover class="flex items-center" />
      </template>
      <template #profile-menu>
        <NavigationProfileMenu />
      </template>
      <template #responsive-menu>
        <NavigationSidebarMenu class="flex items-center" />
      </template>
    </NavigationWrapper>
    <div class="w-11/12 max-w-[850px] mx-auto mt-4">
      <slot />
    </div>
  </div>
</template>
