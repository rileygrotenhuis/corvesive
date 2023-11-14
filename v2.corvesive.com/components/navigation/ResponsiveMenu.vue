<script setup>
const items = [
  [
    {
      label: 'Paystubs',
      click: () => {
        useNuxtApp().$router.push('/paystubs');
      },
    },
    {
      label: 'Bills',
      click: () => {
        useNuxtApp().$router.push('/bills');
      },
    },
    {
      label: 'Budgets',
      click: () => {
        useNuxtApp().$router.push('/budgets');
      },
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
  </UDropdown>
</template>
