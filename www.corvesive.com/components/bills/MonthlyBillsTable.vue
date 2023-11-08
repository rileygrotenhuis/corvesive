<script setup>
import useBillsStore from '~/stores/bills';
import useModalsStore from '~/stores/modals';

const openUpdateModal = (bill) => {
  useModalsStore().openModal('bills.update');

  useBillsStore().populateFormFields(
    bill.id,
    bill.issuer,
    bill.name,
    bill.amount.raw,
    bill.due_date.raw,
    bill.notes
  );
};
</script>

<template>
  <TablesTableWrapper>
    <TablesTableHeaders
      :headers="['Issuer', 'Name', 'Amount', 'Due', 'Notes']"
    />
    <tbody>
      <TablesEmptyTableRow
        message="No Bills found, create your first Bill to get started!"
        v-if="useBillsStore().bills.length === 0"
      />
      <TablesTableRow
        v-for="bill in useBillsStore().bills"
        :key="bill.id"
        @click="openUpdateModal(bill)"
      >
        <TablesTableData>
          {{ bill.issuer }}
        </TablesTableData>
        <TablesTableData>
          {{ bill.name }}
        </TablesTableData>
        <TablesTableData>{{ bill.amount.pretty }}</TablesTableData>
        <TablesTableData>
          {{ bill.due_date.pretty }}
        </TablesTableData>
        <TablesTableData>
          {{ bill.notes }}
        </TablesTableData>
      </TablesTableRow>
    </tbody>
  </TablesTableWrapper>
</template>
