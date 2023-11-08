<script setup lang="ts">
import { ref } from 'vue';
import useAccountStore from '~/stores/account.ts';

const isResponsiveNavigationExpanded = ref(false);
</script>

<template>
  <nav class="bg-black py-4 shadow-xl">
    <div class="flex justify-between w-11/12 max-w-[1000px] mx-auto">
      <div>
        <NuxtLink to="/dashboard" class="items-center">
          <h1 class="text-2xl font-bold text-white">Corvesive</h1>
        </NuxtLink>
      </div>
      <div class="flex gap-24">
        <div class="hidden md:flex gap-10 items-center">
          <NavigationNavbarLink
            v-if="!$route.path.includes('/monthly')"
            to="/monthly"
            text="Monthly"
          />
          <NavigationNavbarLink
            v-if="
              !$route.path.includes('/dashboard') &&
              useAccountStore().user.pay_period?.id
            "
            to="/dashboard"
            text="Pay Period"
          />
        </div>
        <div class="flex items-center gap-8">
          <NavigationProfileMenu />
          <IconsHamburgerIcon
            @click="
              isResponsiveNavigationExpanded = !isResponsiveNavigationExpanded
            "
            class="relative md:hidden hover:cursor-pointer hover:shadow-xl"
          />
        </div>
      </div>
    </div>
    <NavigationExpandedNavigationLinks
      class="inline-block md:hidden"
      :class="{
        flex: isResponsiveNavigationExpanded,
        hidden: !isResponsiveNavigationExpanded,
      }"
    />
  </nav>
</template>
