<script setup>
const isOpen = ref(false);

const router = useNuxtApp().$router;

const links = [
  {
    label: 'Dashboard',
    icon: 'i-heroicons-home',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      router.push('/');
    },
  },
  {
    label: 'Paystubs',
    icon: 'i-heroicons-currency-dollar',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      router.push('/paystubs');
    },
  },
  {
    label: 'Bills',
    icon: 'i-heroicons-credit-card',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      router.push('/bills');
    },
  },
  {
    label: 'Budgets',
    icon: 'i-heroicons-banknotes',
    class: 'text-xl',
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
