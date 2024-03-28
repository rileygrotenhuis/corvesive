<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
import Table from '@/Components/Tables/Table.vue';

defineProps({
  savings: Array,
});

const columns = ['Issuer', 'Amount'];
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
          title="Savings"
          description="View all savings this pay period"
          actionHref="pay-period-savings.settings"
          actionText="+ Add"
          :columns="columns"
          :dataLength="savings.length"
        >
          <TableRow v-for="(saving, index) in savings" :key="index">
            <TableData :value="saving.monthly_saving.name" />
            <TableData :value="`$${saving.amount_in_cents / 100}`" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
