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
      <template #transaction-menu>
        <NavigationTransactionsMenu class="flex items-center" />
      </template>
      <template #pay-period-popover>
        <NavigationPayPeriodPopover class="flex items-center" />
      </template>
      <template #profile-menu>
        <NavigationProfileMenu />
      </template>
    </NavigationWrapper>
    <div class="w-11/12 max-w-[850px] mx-auto">
      <UtilModalUtility />
      <UNotifications />
      <div class="mt-8">
        <slot />
      </div>
    </div>
  </div>
</template>
