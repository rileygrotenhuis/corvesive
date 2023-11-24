<script setup lang="ts">
const accountStore = useAccountStore();
const modalStore = useModalStore();

const menuItems = [
  [
    {
      label: 'Make Deposit',
      click: () => {
        modalStore.openTransactionsModal('deposit');
      },
    },
    {
      label: 'Pay Bill',
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
      <UIcon name="i-heroicons-currency-dollar" class="w-7 h-7" />
      <template #item="{ item }">
        <span class="truncate">{{ item.label }}</span>
      </template>
    </UDropdown>
  </div>
</template>
