<script setup>
import { ref } from 'vue';
import CalendarIcon from '@/Components/Icons/CalendarIcon.vue';
import UserMenuDropdown from '@/Layouts/Partials/UserMenuDropdown.vue';

const pages = ref([
  {
    name: 'Paystubs',
    href: route('paystubs.index'),
  },
  {
    name: 'Expenses',
    href: route('expenses.index'),
  },
]);
</script>

<template>
  <nav>
    <div class="max-w-6xl mx-auto flex justify-between items-center px-8 py-6">
      <div class="flex items-center gap-24">
        <h1 class="text-2xl font-bold">
          <a :href="route('dashboard')"> Corvesive. </a>
        </h1>

        <ul class="flex items-center gap-12">
          <li
            v-for="page in pages"
            :key="page.name"
            class="font-light text-sm hover:font-semibold"
          >
            <a :href="page.href">
              {{ page.name }}
            </a>
          </li>
        </ul>
      </div>

      <div class="flex items-center gap-8">
        <a :href="route('calendar')">
          <CalendarIcon />
        </a>

        <UserMenuDropdown />
      </div>
    </div>
  </nav>
</template>
