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
          :href="route('pay-period-bills.index')"
        >
          + Add
        </Link>
      </div>
    </header>

    <table>
      <thead>
        <tr>
          <th>Issuer</th>
          <th>Name</th>
          <th>Due Date</th>
          <th>Amount Paid</th>
          <th>Amount Due</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="(bill, index) in bills" :key="index">
          <td>{{ bill.bill.issuer }}</td>
          <td>{{ bill.bill.name }}</td>
          <td>{{ new Date(bill.bill.due_date).toLocaleDateString() }}</td>
          <td>${{ bill.amount_paid / 100 }}</td>
          <td>${{ bill.remaining_amount / 100 }}</td>
        </tr>
      </tbody>
    </table>
  </section>
</template>
