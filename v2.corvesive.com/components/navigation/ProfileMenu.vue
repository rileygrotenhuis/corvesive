<script setup lang="ts">
const accountStore = useAccountStore();

const menuItems = [
  [
    {
      label: accountStore.user.email,
      slot: 'account',
      disabled: true,
    },
  ],
  [
    {
      label: 'Account',
      icon: 'i-heroicons-cog-8-tooth',
      click: () => {
        useNuxtApp().$router.push('/account');
      },
    },
  ],
  [
    {
      label: 'Sign out',
      icon: 'i-heroicons-arrow-left-on-rectangle',
      click: async () => {
        await useNuxtApp().$api.auth.logout();
        useNuxtApp().$router.push('/login');
      },
    },
  ],
];
</script>

<template>
  <UDropdown
    :items="menuItems"
    :ui="{ item: { disabled: 'cursor-text select-text' } }"
    :popper="{ placement: 'bottom-end' }"
  >
    <UAvatar :alt="accountStore.user.names.full" size="sm" />

    <template #account="{ item }">
      <div class="text-left">
        <p>Signed in as</p>
        <p class="truncate font-medium text-gray-900 dark:text-white">
          {{ item.label }}
        </p>
      </div>
    </template>

    <template #item="{ item }">
      <span class="truncate">{{ item.label }}</span>

      <UIcon
        :name="item.icon"
        class="flex-shrink-0 h-4 w-4 text-gray-400 dark:text-gray-500 ms-auto"
      />
    </template>
  </UDropdown>
</template>
