<script setup lang="ts">
import useAccountStore from '~/stores/account.js';
import ProfileBlackIcon from '~/components/icons/ProfileBlackIcon.vue';
import copy from '~/libs/locales/copy.js';

useHead({
  title: 'Corvesive - Profile',
});

definePageMeta({
  layout: 'account',
});

await useAccountStore().populateFormFields();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="ProfileBlackIcon"
      title="Profile Details"
      :subtext="copy['account']['profile']"
    />
    <ProfileUpdateProfileForm />
  </div>
</template>
