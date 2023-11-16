<script setup lang="ts">
const accountStore = useAccountStore();

const menuItems = [
  [
    {
      label: 'New Paystub',
      click: () => {
        alert('New Paystub');
      },
    },
    {
      label: 'New Bill',
      click: () => {
        alert('New Bill');
      },
    },
    {
      label: 'New Budget',
      click: () => {
        alert('New Budget');
      },
    },
    {
      label: 'New Saving',
      click: () => {
        alert('New Saving');
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
    <UIcon
      name="i-heroicons-plus"
      :alt="accountStore.user.names.full"
      class="w-5 h-5"
    />
  </UDropdown>
</template>
