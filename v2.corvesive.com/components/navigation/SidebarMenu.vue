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
    label: 'Income',
    icon: 'i-heroicons-currency-dollar',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      router.push('/income');
    },
  },
  {
    label: 'Expenses',
    icon: 'i-heroicons-credit-card',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      router.push('/expenses');
    },
  },
  {
    label: 'Savings',
    icon: 'i-heroicons-banknotes',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      router.push('/savings');
    },
  },
];
</script>

<template>
  <div>
    <UIcon
      name="i-heroicons-bars-3"
      class="w-5 h-5 hover:cursor-pointer"
      @click="isOpen = !isOpen"
    />

    <USlideover v-model="isOpen" side="right">
      <div class="p-4 flex-1">
        <UIcon
          name="i-heroicons-x-mark"
          class="w-8 h-8 hover:cursor-pointer ml-1 mb-2"
          @click="isOpen = false"
        />
        <UVerticalNavigation :links="links" />
      </div>
    </USlideover>
  </div>
</template>
