<script setup lang="ts">
import useTransactionsStore from '~/stores/transactions';
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets.js';

await usePayPeriodBudgetsStore().getPayPeriodBudgets();
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Budget Transaction</h3>
    <form
      @submit.prevent="useTransactionsStore().createBudgetTransaction()"
      class="flex flex-col gap-4"
    >
      <div>
        <FormsInputLabel resource="expense_type" text="Select Budget" />
        <select
          v-model="useTransactionsStore().form.payPeriodExpense"
          class="shadow border rounded w-full py-2 pl-2 pr-16 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
        >
          <option
            v-for="budget in usePayPeriodBudgetsStore().payPeriodBudgets"
            :key="budget.id"
            :value="budget"
          >
            {{ budget.budget.name }}
          </option>
        </select>
      </div>
      <div class="flex flex-col gap-4">
        <h5 class="text-lg">
          <strong>Total Balance: </strong>
          {{
            useTransactionsStore().form.payPeriodExpense?.total_balance
              ?.pretty ?? '$0.00'
          }}
        </h5>
        <h5 class="text-lg">
          <strong>Remaining Balance: </strong>
          {{
            useTransactionsStore().form.payPeriodExpense?.remaining_balance
              ?.pretty ?? '$0.00'
          }}
        </h5>
      </div>
      <div>
        <FormsInputLabel resource="amount" text="Amount" />
        <FormsInputCurrency
          v-model="useTransactionsStore().form.amount"
          name="amount"
          :disabled="useTransactionsStore().form.isLoading"
        />
      </div>
      <FormsFormErrors
        v-if="useTransactionsStore().form.errors"
        :formErrors="useTransactionsStore().form.errors"
      />
      <ButtonsFormSubmitButton
        buttonText="Payment"
        :disabled="useTransactionsStore().form.isLoading"
      />
    </form>
  </div>
</template>
