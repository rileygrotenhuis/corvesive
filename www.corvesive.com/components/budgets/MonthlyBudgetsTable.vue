<script setup>
import useModalsStore from "~/stores/modals";
import useBudgetsStore from "~/stores/budgets.js";

const openUpdateModal = (budget) => {
  useModalsStore().openModal("budgets.update");

  useBudgetsStore().populateFormFields(
    budget.id,
    budget.name,
    budget.amount.raw,
    budget.notes,
  );
};
</script>

<template>
  <TablesTableWrapper>
    <TablesTableHeaders :headers="['Name', 'Amount', 'Notes']" />
    <tbody>
      <TablesEmptyTableRow
        message="No Budgets found, create your first Budget to get started!"
        v-if="useBudgetsStore().budgets.length === 0"
      />
      <TablesTableRow
        v-for="budget in useBudgetsStore().budgets"
        :key="budget.id"
        @click="openUpdateModal(budget)"
      >
        <TablesTableData>
          {{ budget.name }}
        </TablesTableData>
        <TablesTableData>
          {{ budget.amount.pretty }}
        </TablesTableData>
        <TablesTableData>
          {{ budget.notes }}
        </TablesTableData>
      </TablesTableRow>
    </tbody>
  </TablesTableWrapper>
</template>
