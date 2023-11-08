<script setup>
import useModalsStore from '~/stores/modals.js';
import useAlertsStore from '~/stores/alerts.js';
import usePayPeriodsStore from '~/stores/payPeriods.js';
import usePayPeriodPaystubsStore from '~/stores/payPeriodPaystubs.js';

const openUpdateModal = (payPeriodPaystub) => {
  if (usePayPeriodsStore().currentPayPeriod.is_complete) {
    useAlertsStore().addAlert('payPeriodIsCompleted');
    return;
  }

  useModalsStore().openModal('payPeriods.paystubs.update');

  usePayPeriodPaystubsStore().populateFormFields(
    usePayPeriodsStore().currentPayPeriod.id,
    payPeriodPaystub.paystub.id,
    payPeriodPaystub.amount.raw
  );

  usePayPeriodPaystubsStore().setSelectedPayPeriodPaystub(
    payPeriodPaystub.paystub
  );
};
</script>

<template>
  <TablesTableWrapper>
    <TablesTableHeaders :headers="['Issuer', 'Amount']" />
    <tbody>
      <TablesEmptyTableRow
        v-if="usePayPeriodPaystubsStore().payPeriodPaystubs.length === 0"
        message="No Paystubs have been selected for this Pay Period."
      />
      <TablesTableRow
        v-for="payPeriodPaystub in usePayPeriodPaystubsStore()
          .payPeriodPaystubs"
        :key="payPeriodPaystub.id"
      >
        <TablesTableData @click="openUpdateModal(payPeriodPaystub)">
          {{ payPeriodPaystub.paystub.issuer }}
        </TablesTableData>
        <TablesTableData @click="openUpdateModal(payPeriodPaystub)">
          {{ payPeriodPaystub.amount.pretty }}
        </TablesTableData>
      </TablesTableRow>
    </tbody>
  </TablesTableWrapper>
</template>
