<script setup lang="ts">
import useAlertsStore from '~/stores/alerts';
import useModalsStore from '~/stores/modals';
import usePayPeriodsStore from '~/stores/payPeriods';
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets';

const openUpdateModal = (payPeriodBudget: Object) => {
  if (usePayPeriodsStore().currentPayPeriod.is_complete) {
    useAlertsStore().addAlert('payPeriodIsCompleted');
    return;
  }

  useModalsStore().openModal('payPeriods.budgets.update');

  usePayPeriodBudgetsStore().populateFormFields(
    usePayPeriodsStore().currentPayPeriod.id,
    payPeriodBudget.budget.id,
    payPeriodBudget.total_balance.raw,
    payPeriodBudget.remaining_balance.raw
  );

  usePayPeriodBudgetsStore().setSelectedPayPeriodBudget(payPeriodBudget.budget);
};

const getPayPeriodBudgetRowColor = (remainingBalance: Number): String => {
  if (remainingBalance === 0) {
    return 'bg-green-200';
  }

  if (remainingBalance < 0) {
    return 'bg-red-200';
  }

  if (remainingBalance > 0 && remainingBalance <= 1000) {
    return 'bg-yellow-100';
  }

  return 'bg-white';
};
</script>

<template>
  <TablesTableWrapper>
    <TablesTableHeaders
      :headers="['Name', 'Total Balance', 'Remaining Balance']"
    />
    <tbody>
      <TablesEmptyTableRow
        v-if="usePayPeriodBudgetsStore().payPeriodBudgets.length === 0"
        message="No Budgets have been selected for this Pay Period."
      />
      <TablesTableRow
        v-for="payPeriodBudget in usePayPeriodBudgetsStore().payPeriodBudgets"
        :key="payPeriodBudget.id"
        :rowColor="
          getPayPeriodBudgetRowColor(payPeriodBudget.remaining_balance.raw)
        "
      >
        <TablesTableData @click="openUpdateModal(payPeriodBudget)">
          {{ payPeriodBudget.budget.name }}
        </TablesTableData>
        <TablesTableData @click="openUpdateModal(payPeriodBudget)">
          {{ payPeriodBudget.total_balance.pretty }}
        </TablesTableData>
        <TablesTableData @click="openUpdateModal(payPeriodBudget)">
          {{ payPeriodBudget.remaining_balance.pretty }}
        </TablesTableData>
      </TablesTableRow>
    </tbody>
  </TablesTableWrapper>
</template>
