<script setup lang="ts">
const accountStore = useAccountStore();
const modalStore = useModalStore();

const menuItems = [
  [
    {
      label: 'Add new recurring:',
      slot: 'title',
      disabled: true,
    },
  ],
  [
    {
      label: 'Paystub',
      click: () => {
        modalStore.openRecurringModal('paystubs');
      },
    },
    {
      label: 'Bill',
      click: () => {
        modalStore.openRecurringModal('bills');
      },
    },
    {
      label: 'Budget',
      click: () => {
        modalStore.openRecurringModal('budgets');
      },
    },
    {
      label: 'Saving',
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

    <template #title="{ item }">
      <div class="text-left">
        <p class="truncate font-medium text-gray-900 dark:text-white">
          {{ item.label }}
        </p>
      </div>
    </template>

    <template #item="{ item }">
      <span class="truncate">{{ item.label }}</span>
    </template>
  </UDropdown>
</template>
