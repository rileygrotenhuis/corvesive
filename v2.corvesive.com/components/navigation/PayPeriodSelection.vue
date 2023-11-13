<script setup>
const items = [
  [
    {
      label: 'Pay Periods',
      disabled: true,
      slot: 'account',
    },
  ],
  [
    {
      label: '11/5/2023 - 11/20/2023',
    },
    {
      label: '11/20/2023 - 12/5/2023',
    },
    {
      label: '11/20/2023 - 12/5/2023',
    },
    {
      label: '11/20/2023 - 12/5/2023',
    },
    {
      label: '11/20/2023 - 12/5/2023',
    },
    {
      label: '11/20/2023 - 12/5/2023',
    },
    {
      label: '11/20/2023 - 12/5/2023',
    },
  ],
];
</script>

<template>
  <UDropdown
    :items="items"
    :ui="{ item: { disabled: 'cursor-text select-text' } }"
    :popper="{ placement: 'bottom-end' }"
    class="items-center"
  >
    <UIcon name="i-heroicons-calendar" />

    <template #account="{ item }">
      <div class="text-left">
        <p class="truncate font-medium text-gray-900 dark:text-white">
          Pay Periods
        </p>
      </div>
    </template>

    <template #item="{ item }">
      <span class="truncate">{{ item.label }}</span>
    </template>
  </UDropdown>
</template>
