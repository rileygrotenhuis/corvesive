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
        <NavigationResponsiveMenu class="flex md:hidden items-center" />
      </template>
    </NavigationWrapper>
    <div class="w-11/12 max-w-[850px] mx-auto">
      <slot />
    </div>
  </div>
</template>
