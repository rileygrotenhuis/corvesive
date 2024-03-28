<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
import Table from '@/Components/Tables/Table.vue';

defineProps({
  bills: Array,
});

const columns = ['Issuer', 'Name', 'Due Date', 'Total', 'Due'];
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
          title="Bills"
          description="View all bills this pay period"
          actionHref="pay-period-bills.settings"
          actionText="+ Add"
          :columns="columns"
          :dataLength="bills.length"
        >
          <TableRow v-for="(bill, index) in bills" :key="index">
            <TableData :value="bill.bill.issuer" />
            <TableData :value="bill.bill.name" />
            <TableData :value="new Date(bill.due_date).toLocaleDateString()" />
            <TableData :value="`$${bill.amount_in_cents / 100}`" />
            <TableData :value="`$${bill.remaining_amount / 100}`" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
