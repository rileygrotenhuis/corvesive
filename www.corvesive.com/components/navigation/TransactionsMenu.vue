<script setup lang="ts">
const accountStore = useAccountStore();
const modalStore = useModalStore();

const menuItems = [
  [
    {
      label: 'New Transaction:',
      slot: 'title',
      disabled: true,
    },
  ],
  [
    {
      label: 'Make a Deposit',
      click: () => {
        modalStore.openTransactionsModal('deposit');
      },
    },
    {
      label: 'Pay a Bill',
      click: () => {
        modalStore.openTransactionsModal('bill');
      },
    },
    {
      label: 'Pay off Budget',
      click: () => {
        modalStore.openTransactionsModal('budget');
      },
    },
  ],
];
</script>

<template>
  <div class="w-fit ml-auto">
    <UDropdown
      :items="menuItems"
      :ui="{ item: { disabled: 'cursor-text select-text' } }"
      :popper="{ placement: 'bottom-end' }"
    >
      <UIcon name="i-heroicons-currency-dollar" class="w-5 h-5" />

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
  </div>
</template>
