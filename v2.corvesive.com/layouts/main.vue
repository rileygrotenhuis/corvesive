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
      <template #create-menu>
        <NavigationCreateMenu class="flex items-center" />
      </template>
      <template #pay-period-popover>
        <NavigationPayPeriodPopover class="flex items-center" />
      </template>
      <template #profile-menu>
        <NavigationProfileMenu />
      </template>
      <template #sidebar-menu>
        <NavigationSidebarMenu class="flex items-center" />
      </template>
    </NavigationWrapper>
    <div class="w-11/12 max-w-[850px] mx-auto">
      <NavigationTransactionsMenu class="mt-4 mb-4" />
      <UtilModalUtility />
      <UNotifications />
      <slot />
    </div>
  </div>
</template>
