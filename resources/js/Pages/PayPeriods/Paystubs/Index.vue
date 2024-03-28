<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
import Table from '@/Components/Tables/Table.vue';

defineProps({
  paystubs: Array,
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
          title="Paystubs"
          description="View all paystubs this pay period"
          actionHref="pay-period-paystubs.settings"
          actionText="+ Add"
          :columns="columns"
          :dataLength="paystubs.length"
        >
          <TableRow v-for="(paystub, index) in paystubs" :key="index">
            <TableData :value="paystub.paystub.issuer" />
            <TableData :value="`$${paystub.amount_in_cents / 100}`" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
