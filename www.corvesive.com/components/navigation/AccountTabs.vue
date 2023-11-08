<script setup lang="ts">
import type { PageTabs } from '~/types/PageTabs';

const tabs: PageTabs[] = [
  {
    url: '/account/profile',
    text: 'Profile',
  },
];
</script>

<template>
  <NavigationTabs :tabs="tabs" />
</template>
