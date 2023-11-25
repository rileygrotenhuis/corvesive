<script setup lang="ts">
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
    label: 'Reporting',
    icon: 'i-heroicons-chart-bar',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      alert('THIS PAGE DOES NOT EXIST YET');
    },
  },
  {
    label: 'Transactions',
    icon: 'i-heroicons-currency-dollar',
    class: 'text-xl',
    click: () => {
      isOpen.value = false;
      alert('THIS PAGE DOES NOT EXIST YET');
    },
  },
];
</script>

<template>
  <div>
    <UIcon
      name="i-heroicons-bars-3"
      class="w-6 h-6 hover:cursor-pointer"
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
