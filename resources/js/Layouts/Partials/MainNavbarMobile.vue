<script setup>
import { markRaw, ref } from 'vue';
import HamburgerMenuIcon from '@/Components/Icons/HamburgerMenuIcon.vue';
import IncomeIcon from '@/Components/Icons/IncomeIcon.vue';
import ExpenseIcon from '@/Components/Icons/ExpenseIcon.vue';
import MiniCalendarIcon from '@/Components/Icons/MiniCalendarIcon.vue';
import ProfileIcon from '@/Components/Icons/ProfileIcon.vue';
import LogoutIcon from '@/Components/Icons/LogoutIcon.vue';
import { useForm } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);

const pages = ref([
  {
    name: 'Paystubs',
    href: route('paystubs.index'),
    icon: markRaw(IncomeIcon),
  },
  {
    name: 'Expenses',
    href: route('expenses.index'),
    icon: markRaw(ExpenseIcon),
  },
  {
    name: 'Calendar',
    href: route('calendar'),
    icon: markRaw(MiniCalendarIcon),
  },
]);

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value;
};

const logout = () => {
  useForm({}).delete(route('logout'));
};
</script>

<template>
  <nav class="relative flex justify-between items-center px-8 py-6 z-40">
    <div class="z-50">
      <h1
        class="text-2xl font-bold transition-colors ease-in-out"
        :class="{
          'text-white': !mobileMenuOpen,
          'text-black': mobileMenuOpen,
        }"
      >
        <a :href="route('dashboard')"> Corvesive. </a>
      </h1>
    </div>

    <div class="z-50">
      <button @click.prevent="toggleMobileMenu">
        <HamburgerMenuIcon
          class="transition-colors ease-in-out"
          :class="{
            'text-white': !mobileMenuOpen,
            'text-black': mobileMenuOpen,
          }"
        />
      </button>
    </div>

    <div v-show="mobileMenuOpen" class="fixed inset-0 bg-white px-8 py-24">
      <ul class="flex flex-col gap-8">
        <li
          v-for="page in pages"
          :key="page.name"
          class="text-black font-normal hover:font-semibold"
        >
          <a :href="page.href" class="flex items-center gap-4">
            <component :is="page.icon" />
            <span>{{ page.name }}</span>
          </a>
        </li>
      </ul>

      <hr class="border-1 border-gray-200 my-8" />

      <ul class="flex flex-col gap-8">
        <li class="text-black font-normal hover:font-semibold">
          <a :href="route('profile.edit')" class="flex items-center gap-4">
            <ProfileIcon />
            <span>Profile</span>
          </a>
        </li>
        <li class="text-black font-normal hover:font-semibold">
          <button class="flex items-center gap-4" @click.prevent="logout">
            <LogoutIcon />
            <span>Logout</span>
          </button>
        </li>
      </ul>
    </div>
  </nav>
</template>
