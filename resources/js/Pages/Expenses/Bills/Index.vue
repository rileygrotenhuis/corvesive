<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import MonthlyExpenseHeader from '@/Pages/Expenses/Partials/MonthlyExpenseHeader.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
import Table from '@/Components/Tables/Table.vue';

defineProps({
  monthlyBills: Array,
});

const columns = [
  'Issuer',
  'Name',
  'Due Day of Month',
  'Total',
  'Remaining this Month',
  'Notes',
];

const gotoBill = (bill) => {
  router.visit(route('bills.show', bill.id));
};
</script>

<template>
  <Head title="Bills" />

  <AuthenticatedLayout>
    <template #header>
      <MonthlyExpenseHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <Table
          title="Monthly Bills"
          description="View all monthly bills"
          actionHref="bills.create"
          actionText="+ Bill"
          :columns="columns"
          :dataLength="monthlyBills.length"
        >
          <TableRow
            v-for="(bill, index) in monthlyBills"
            :key="index"
            @click="gotoBill(bill)"
          >
            <TableData :value="bill.issuer" />
            <TableData :value="bill.name" />
            <TableData :value="bill.due_day_of_month" />
            <TableData :value="`$${bill.amount_in_cents / 100}`" />
            <TableData :value="`$${bill.remaining_amount / 100}`" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
