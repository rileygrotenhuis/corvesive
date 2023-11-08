<script setup lang="ts">
import useModalsStore from '~/stores/modals';
import useAlertsStore from '~/stores/alerts';
import usePayPeriodsStore from '~/stores/payPeriods';
import usePayPeriodBillsStore from '~/stores/payPeriodBills';

const openUpdateModal = (payPeriodBill) => {
  if (usePayPeriodsStore().currentPayPeriod.is_complete) {
    useAlertsStore().addAlert('payPeriodIsCompleted');
    return;
  }

  useModalsStore().openModal('payPeriods.bills.update');

  usePayPeriodBillsStore().populateFormFields(
    usePayPeriodsStore().currentPayPeriod.id,
    payPeriodBill.bill.id,
    payPeriodBill.amount.raw,
    payPeriodBill.dates.due.pretty.input
  );

  usePayPeriodBillsStore().setSelectedPayPeriodBill(payPeriodBill.bill);
};

const getPayPeriodBillRowColor = (status) => {
  const payPeriodBillStatusColorMappings = {
    unpayed: 'bg-white',
    upcoming: 'bg-yellow-100',
    payed: 'bg-green-200',
    late: 'bg-red-200',
  };

  return payPeriodBillStatusColorMappings[status];
};
</script>

<template>
  <TablesTableWrapper>
    <TablesTableHeaders
      :headers="['Issuer', 'Name', 'Amount', 'Due Date', 'Has Payed']"
    />
    <tbody>
      <TablesEmptyTableRow
        v-if="usePayPeriodBillsStore().payPeriodBills.length === 0"
        message="No Bills have been selected for this Pay Period."
      />
      <TablesTableRow
        v-for="payPeriodBill in usePayPeriodBillsStore().payPeriodBills"
        :key="payPeriodBill.id"
        :rowColor="getPayPeriodBillRowColor(payPeriodBill.status)"
      >
        <TablesTableData @click="openUpdateModal(payPeriodBill)">
          {{ payPeriodBill.bill.issuer }}
        </TablesTableData>
        <TablesTableData @click="openUpdateModal(payPeriodBill)">
          {{ payPeriodBill.bill.name }}
        </TablesTableData>
        <TablesTableData @click="openUpdateModal(payPeriodBill)">
          {{ payPeriodBill.amount.pretty }}
        </TablesTableData>
        <TablesTableData @click="openUpdateModal(payPeriodBill)">
          {{ payPeriodBill.dates.due.pretty.full }}
        </TablesTableData>
        <TablesTableData @click="openUpdateModal(payPeriodBill)">
          {{ payPeriodBill.has_payed ? 'Yes' : 'No' }}
        </TablesTableData>
      </TablesTableRow>
    </tbody>
  </TablesTableWrapper>
</template>
