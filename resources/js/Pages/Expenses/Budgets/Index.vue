<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import MonthlyExpenseHeader from '@/Pages/Expenses/Partials/MonthlyExpenseHeader.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
import Table from '@/Components/Tables/Table.vue';

defineProps({
  monthlyBudgets: Array,
});

const columns = ['Name', 'Total Balance', 'Remaining Balance', 'Notes'];

const gotoBudget = (budget) => {
  router.visit(route('budgets.show', budget.id));
};
</script>

<template>
  <Head title="Budgets" />

  <AuthenticatedLayout>
    <template #header>
      <MonthlyExpenseHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <Table
          title="Monthly Budgets"
          description="View all monthly budgets"
          actionHref="budgets.create"
          actionText="+ Budget"
          :columns="columns"
          :dataLength="monthlyBudgets.length"
        >
          <TableRow
            v-for="(budget, index) in monthlyBudgets"
            :key="index"
            @click="gotoBudget(budget)"
          >
            <TableData :value="budget.name" />
            <TableData :value="`$${budget.total_balance_in_cents / 100}`" />
            <TableData :value="`$${budget.remaining_balance / 100}`" />
            <TableData :value="budget.notes" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
