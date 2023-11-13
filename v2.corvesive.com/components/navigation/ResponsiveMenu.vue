<script setup>
const items = [
  [
    {
      label: 'Paystubs',
      to: '/paystubs',
    },
    {
      label: 'Bills',
      to: '/bills',
    },
    {
      label: 'Budgets',
      to: '/budgets',
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
    <UIcon name="i-heroicons-bars-3" class="w-5 h-5" />

    <template #item="{ item }">
      <router-link :to="item.to" class="truncate">{{ item.label }}</router-link>
    </template>
  </UDropdown>
</template>
