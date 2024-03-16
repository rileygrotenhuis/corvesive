<script setup>
  import { Head, Link } from '@inertiajs/vue3'
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import { router } from '@inertiajs/vue3'
  import MonthlyExpenseHeader from '@/Pages/Monthly/Partials/MonthlyExpenseHeader.vue'

  defineProps({
    monthlyBudgets: Array
  })

  const columns = ['Name', 'Total Balance', 'Notes']

  const gotoBudget = (budget) => {
    router.visit(route('budgets.show', budget.id))
  }
</script>

<template>
  <Head title="Budgets" />

  <AuthenticatedLayout>
    <template #header>
      <MonthlyExpenseHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <section>
            <header>
              <div class="flex justify-between items-center">
                <div>
                  <h2
                    class="text-lg font-medium text-gray-900 dark:text-gray-100"
                  >
                    Your Monthly Budgets
                  </h2>

                  <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                    Your collection of monthly budgets.
                  </p>
                </div>
                <Link
                  :href="route('budgets.create')"
                  class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                >
                  + Budget
                </Link>
              </div>
            </header>

            <table
              class="mt-6 min-w-full divide-y divide-gray-200 dark:divide-gray-700"
            >
              <thead class="bg-gray-50 dark:bg-gray-700">
                <tr>
                  <th
                    scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider"
                    v-for="(column, index) in columns"
                    :key="index"
                  >
                    {{ column }}
                  </th>
                </tr>
              </thead>
              <tbody
                class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700"
              >
                <tr
                  v-for="(budget, index) in monthlyBudgets"
                  :key="index"
                  class="hover:bg-gray-900 hover:cursor-pointer"
                  @click="gotoBudget(budget)"
                >
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-100">
                      {{ budget.name }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-100">
                      ${{ budget.total_balance_in_cents / 100 }}
                    </div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900 dark:text-gray-100">
                      {{ budget.notes }}
                    </div>
                  </td>
                </tr>
              </tbody>
            </table>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
