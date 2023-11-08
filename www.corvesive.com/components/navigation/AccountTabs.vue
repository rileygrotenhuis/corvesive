<script setup>
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
