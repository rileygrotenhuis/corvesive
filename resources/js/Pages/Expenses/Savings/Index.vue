<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import MonthlyExpenseHeader from '@/Pages/Expenses/Partials/MonthlyExpenseHeader.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
import Table from '@/Components/Tables/Table.vue';

defineProps({
  monthlySavings: Array,
});

const columns = ['Name', 'Total', 'Remaining this Month', 'Notes'];

const gotoSaving = (saving) => {
  router.visit(route('savings.show', saving.id));
};
</script>

<template>
  <Head title="Savings" />

  <AuthenticatedLayout>
    <template #header>
      <MonthlyExpenseHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <Table
          title="Monthly Savings"
          description="View all monthly savings"
          actionHref="savings.create"
          actionText="+ Saving"
          :columns="columns"
          :dataLength="monthlySavings.length"
        >
          <TableRow
            v-for="(saving, index) in monthlySavings"
            :key="index"
            @click="gotoSaving(saving)"
          >
            <TableData :value="saving.name" />
            <TableData :value="`$${saving.amount_in_cents / 100}`" />
            <TableData :value="`$${saving.remaining_amount / 100}`" />
            <TableData :value="saving.notes" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
