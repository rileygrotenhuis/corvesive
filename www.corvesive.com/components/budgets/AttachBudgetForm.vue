<script setup>
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets';
import useBudgetsStore from '~/stores/budgets.js';

await useBudgetsStore().getBudgets();
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Attach Budget to this Pay Period</h3>
    <form
      @submit.prevent="usePayPeriodBudgetsStore().attachBudgetToPayPeriod()"
      class="flex flex-col gap-4"
    >
      <div>
        <FormsInputLabel resource="budget" text="Select Budget" />
        <BudgetsBudgetSelection />
      </div>
      <div>
        <FormsInputLabel resource="total_balance" text="Total Balance" />
        <FormsInputCurrency
          v-model="usePayPeriodBudgetsStore().form.totalBalance"
          name="amount"
          :disabled="usePayPeriodBudgetsStore().form.isLoading"
        />
      </div>
      <FormsFormErrors
        v-if="usePayPeriodBudgetsStore().form.errors"
        :formErrors="usePayPeriodBudgetsStore().form.errors"
      />
      <ButtonsFormSubmitButton
        buttonText="Save"
        :disabled="usePayPeriodBudgetsStore().form.isLoading"
      />
    </form>
  </div>
</template>
