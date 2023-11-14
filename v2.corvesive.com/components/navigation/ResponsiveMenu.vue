<script setup>
const isOpen = ref(false);

const router = useNuxtApp().$router;

const links = [
  {
    label: 'Dashboard',
    icon: 'i-heroicons-home',
    click: () => {
      isOpen.value = false;
      router.push('/');
    },
  },
  {
    label: 'Paystubs',
    icon: 'i-heroicons-currency-dollar',
    click: () => {
      isOpen.value = false;
      router.push('/paystubs');
    },
  },
  {
    label: 'Bills',
    icon: 'i-heroicons-credit-card',
    click: () => {
      isOpen.value = false;
      router.push('/bills');
    },
  },
  {
    label: 'Budgets',
    icon: 'i-heroicons-banknotes',
    click: () => {
      isOpen.value = false;
      router.push('/budgets');
    },
  },
];
</script>

<template>
  <div>
    <UIcon
      name="i-heroicons-bars-3"
      class="w-5 h-5"
      @click="isOpen = !isOpen"
    />

    <USlideover v-model="isOpen" side="left">
      <div class="p-4 flex-1">
        <UVerticalNavigation :links="links" />
      </div>
    </USlideover>
  </div>
</template>
