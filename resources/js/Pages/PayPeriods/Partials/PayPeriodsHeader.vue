<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div
    class="flex flex-col md:flex-row gap-8 justify-center sm:justify-between items-center"
  >
    <Link
      :href="route('pay-periods.index')"
      class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
    >
      Pay Periods
    </Link>
    <div class="flex gap-16 items-center">
      <div>LIST GOES HERE</div>
      <Link
        class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
        :href="route('pay-periods.create')"
      >
        + New
      </Link>
    </div>
  </div>
</template>
