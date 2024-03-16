<script setup>
import { Link } from '@inertiajs/vue3';

const isActive = (route) => {
  return window.location.pathname.includes(route);
};
</script>

<template>
  <div
    class="flex flex-col md:flex-row justify-center md:justify-start gap-8 md:gap-16"
  >
    <Link
      :href="route('expenses.index')"
      class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
    >
      Expenses
    </Link>
    <ul class="flex justify-center items-center gap-16">
      <li>
        <Link
          :href="route('bills.index')"
          class="font-semibold text-gray-400 leading-tight"
          :class="{ 'text-gray-800 dark:text-gray-100': isActive('bills') }"
        >
          Bills
        </Link>
      </li>
      <li>
        <Link
          :href="route('budgets.index')"
          class="font-semibold text-gray-400 leading-tight"
          :class="{ 'text-gray-800 dark:text-gray-100': isActive('budgets') }"
        >
          Budgets
        </Link>
      </li>
      <li>
        <Link
          :href="route('savings.index')"
          class="font-semibold text-gray-400 leading-tight"
          :class="{ 'text-gray-800 dark:text-gray-100': isActive('savings') }"
        >
          Savings
        </Link>
      </li>
    </ul>
  </div>
</template>
