<script setup lang="ts">
import useModalsStore from '~/stores/modals';
import usePaystubsStore from '~/stores/paystubs';

const openUpdateModal = (paystub) => {
  useModalsStore().openModal('paystubs.update');

  usePaystubsStore().populateFormFields(
    paystub.id,
    paystub.issuer,
    paystub.amount.raw,
    paystub.notes
  );
};
</script>

<template>
  <TablesTableWrapper>
    <TablesTableHeaders :headers="['Issuer', 'Amount', 'Notes']" />
    <tbody>
      <TablesEmptyTableRow
        v-if="usePaystubsStore().paystubs.length === 0"
        message="No Paystubs found, create your first Paystub to get started!"
      />
      <TablesTableRow
        v-for="paystub in usePaystubsStore().paystubs"
        :key="paystub.id"
        @click="openUpdateModal(paystub)"
      >
        <TablesTableData>
          {{ paystub.issuer }}
        </TablesTableData>
        <TablesTableData>{{ paystub.amount.pretty }}</TablesTableData>
        <TablesTableData>
          {{ paystub.notes }}
        </TablesTableData>
      </TablesTableRow>
    </tbody>
  </TablesTableWrapper>
</template>
