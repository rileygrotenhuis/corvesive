<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
import Table from '@/Components/Tables/Table.vue';

defineProps({
  budgets: Array,
});

const columns = ['Name', 'Total', 'Remaining'];
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <PayPeriodsHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <Table
          title="Budgets"
          description="View all budgets this pay period"
          actionHref="pay-period-budgets.settings"
          actionText="+ Add"
          :columns="columns"
          :dataLength="budgets.length"
        >
          <TableRow v-for="(budget, index) in budgets" :key="index">
            <TableData :value="budget.budget.name" />
            <TableData :value="`$${budget.total_balance_in_cents / 100}`" />
            <TableData :value="`$${budget.remaining_balance / 100}`" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
