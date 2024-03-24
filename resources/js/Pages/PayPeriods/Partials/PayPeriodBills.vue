<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  bills: Array,
});
</script>

<template>
  <section>
    <header>
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            Bills
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            View and manage your bills during this pay period.
          </p>
        </div>
        <Link
          class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
          :href="route('pay-period-bills.settings')"
        >
          + Add
        </Link>
      </div>
    </header>

    <div class="overflow-x-auto">
      <table class="min-w-full divide-y divide-gray-700 dark:bg-gray-800 mt-8">
        <thead>
          <tr>
            <th
              class="px-6 py-3 bg-gray-800 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-300 uppercase tracking-wider"
            >
              Issuer
            </th>
            <th
              class="px-6 py-3 bg-gray-800 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-300 uppercase tracking-wider"
            >
              Name
            </th>
            <th
              class="px-6 py-3 bg-gray-800 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-300 uppercase tracking-wider"
            >
              Due Date
            </th>
            <th
              class="px-6 py-3 bg-gray-800 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-300 uppercase tracking-wider"
            >
              Amount Paid
            </th>
            <th
              class="px-6 py-3 bg-gray-800 dark:bg-gray-700 text-left text-xs leading-4 font-medium text-gray-300 uppercase tracking-wider"
            >
              Amount Due
            </th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(bill, index) in bills"
            :key="index"
            class="bg-gray-900 dark:bg-gray-800"
          >
            <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
              {{ bill.bill.issuer }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
              {{ bill.bill.name }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
              {{ new Date(bill.bill.due_date).toLocaleDateString() }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
              ${{ bill.amount_paid / 100 }}
            </td>
            <td class="px-6 py-4 whitespace-no-wrap text-gray-300">
              ${{ bill.remaining_amount / 100 }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
</template>
