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
      <NavigationPayPeriodPopover
        v-slot:pay-period-popover
        class="flex items-center"
      />
      <NavigationProfileMenu v-slot:profile-menu />
      <NavigationResponsiveMenu
        v-slot:responsive-menu
        class="flex md:hidden items-center"
      />
    </NavigationTopNavigationBar>
    <div class="w-11/12 max-w-[850px] mx-auto">
      <slot />
    </div>
  </div>
</template>
