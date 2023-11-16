<script setup lang="ts">
const accountStore = useAccountStore();
const modalStore = useModalStore();

const menuItems = [
  [
    {
      label: 'New Paystub',
      click: () => {
        modalStore.openRecurringModal('paystubs');
      },
    },
    {
      label: 'New Bill',
      click: () => {
        modalStore.openRecurringModal('bills');
      },
    },
    {
      label: 'New Budget',
      click: () => {
        modalStore.openRecurringModal('budgets');
      },
    },
    {
      label: 'New Saving',
      click: () => {
        modalStore.openRecurringModal('savings');
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
