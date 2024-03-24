<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  savings: Array,
});
</script>

<template>
  <section>
    <header>
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Savings
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            View and manage your savings during this pay period.
          </p>
        </div>
        <Link
          class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
          :href="route('pay-period-savings.index')"
        >
          + Add
        </Link>
      </div>
    </header>

    <ul class="mt-4 list-disc">
      <li
        v-for="(saving, index) in savings"
        :key="index"
        class="text-white list-disc ml-8"
      >
        {{ saving.name }} - ${{ saving.pivot.amount_in_cents / 100 }}
      </li>
    </ul>
  </section>
</template>
