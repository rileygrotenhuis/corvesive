<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { router } from '@inertiajs/vue3';
import IncomeHeader from '@/Pages/Income/Partials/IncomeHeader.vue';
import Table from '@/Components/Tables/Table.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';

defineProps({
  paystubs: Array,
});

const columns = ['Issuer', 'Amount', 'Issued Day of Month', 'Notes'];

const gotoPaystub = (paystub) => {
  router.visit(route('paystubs.show', paystub.id));
};
</script>

<template>
  <Head title="Paystubs" />

  <AuthenticatedLayout>
    <template #header>
      <IncomeHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <Table
          title="Paystubs"
          description="View all paystubs"
          actionHref="paystubs.create"
          actionText="+ Paystub"
          :columns="columns"
          :dataLength="paystubs.length"
        >
          <TableRow
            v-for="(paystub, index) in paystubs"
            :key="index"
            @click="gotoPaystub(paystub)"
          >
            <TableData :value="paystub.issuer" />
            <TableData :value="`$${paystub.amount_in_cents / 100}`" />
            <TableData :value="paystub.issued_day_of_month" />
            <TableData :value="paystub.notes" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
