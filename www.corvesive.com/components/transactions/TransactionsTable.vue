<script setup lang="ts">
import useTransactionsStore from '~/stores/transactions.js';
import useModalsStore from '~/stores/modals.js';

const openUpdateModal = (transaction) => {
  useModalsStore().openModal('transactions.update');

  useTransactionsStore().populateFormFields(
    transaction.id,
    transaction.amount.raw,
    transaction.notes
  );
};
</script>

<template>
  <TablesTableWrapper>
    <TablesTableHeaders
      :headers="[
        'Type',
        'Amount',
        'Expense Type',
        'Expense Name',
        'Notes',
        'Date/Time',
      ]"
    />
    <tbody>
      <TablesEmptyTableRow
        message="No Transactions found!"
        v-if="useTransactionsStore().transactions.length === 0"
      />
      <TablesTableRow
        v-for="transaction in useTransactionsStore().transactions"
        :key="transaction.id"
        @click="openUpdateModal(transaction)"
      >
        <TablesTableData>{{ transaction.type }}</TablesTableData>
        <TablesTableData>
          {{ transaction.amount.pretty }}
        </TablesTableData>
        <TablesTableData>
          {{
            transaction.pay_period_budget?.id
              ? 'Budget'
              : transaction.pay_period_bill?.id
              ? 'Bill'
              : '--'
          }}
        </TablesTableData>
        <TablesTableData>
          {{
            transaction.pay_period_budget?.id
              ? transaction.pay_period_budget?.budget?.name
              : transaction.pay_period_bill?.id
              ? transaction.pay_period_bill?.bill?.name
              : '--'
          }}
        </TablesTableData>
        <TablesTableData>
          {{ transaction.notes }}
        </TablesTableData>
        <TablesTableData>
          {{ transaction.dates.created.pretty }}
        </TablesTableData>
      </TablesTableRow>
    </tbody>
  </TablesTableWrapper>
</template>
