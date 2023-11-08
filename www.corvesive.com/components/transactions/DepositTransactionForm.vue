<script setup>
import useTransactionsStore from "~/stores/transactions";
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <div>
      <h3 class="text-xl font-bold mb-4">Deposit</h3>
    </div>
    <form
      @submit.prevent="useTransactionsStore().makePayPeriodDeposit"
      class="flex flex-col gap-4"
    >
      <div>
        <FormsInputLabel resource="amount" text="Amount" />
        <FormsInputCurrency
          v-model="useTransactionsStore().form.amount"
          name="amount"
          :disabled="useTransactionsStore().form.isLoading"
        />
      </div>
      <div>
        <FormsInputLabel resource="notes" text="Notes" />
        <FormsInputTextArea
          v-model="useTransactionsStore().form.notes"
          name="notes"
          :disabled="useTransactionsStore().form.isLoading"
        />
      </div>
      <FormsFormErrors
        v-if="useTransactionsStore().form.errors"
        :formErrors="useTransactionsStore().form.errors"
      />
      <ButtonsFormSubmitButton
        buttonText="Deposit"
        :disabled="useTransactionsStore().form.isLoading"
      />
    </form>
  </div>
</template>
