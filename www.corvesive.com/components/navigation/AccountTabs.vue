<script setup lang="ts">
const tabs = [
  {
    url: '/account/profile',
    text: 'Profile',
  },
];
</script>

<template>
  <NavigationTabs :tabs="tabs" />
</template>
