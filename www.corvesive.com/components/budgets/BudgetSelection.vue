<script setup>
import { ref, watch } from 'vue';
import useBudgetsStore from '~/stores/budgets';
import usePayPeriodsStore from '~/stores/payPeriods';
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets';

const selectedBudget = ref(undefined);
watch(selectedBudget, (newValue) => {
  usePayPeriodBudgetsStore().populateFormFields(
    usePayPeriodsStore().currentPayPeriod.id,
    newValue.id,
    newValue.amount.raw,
    undefined
  );
});

const isBudgetDisabled = (budgetId) => {
  return usePayPeriodBudgetsStore().payPeriodBudgets.some(
    (budget) => budget['budget']['id'] === budgetId
  );
};
</script>

<template>
  <select
    v-model="selectedBudget"
    class="shadow border rounded w-full py-2 pl-2 pr-16 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
  >
    <option
      v-for="budget in useBudgetsStore().budgets"
      :key="budget.id"
      :value="budget"
      :disabled="isBudgetDisabled(budget.id)"
    >
      {{ budget.name }}
    </option>
  </select>
</template>
