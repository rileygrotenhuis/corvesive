<script setup lang="ts">
import useTransactionsStore from '~/stores/transactions.ts';

const form = useTransactionsStore();
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Modify Transaction</h3>
    <form
      @submit.prevent="useTransactionsStore().updateTransaction()"
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
          name="issuer"
          :disabled="useTransactionsStore().form.isLoading"
        />
      </div>
      <FormsFormErrors
        v-if="useTransactionsStore().form.errors"
        :formErrors="useTransactionsStore().form.errors"
      />
      <div class="flex gap-4">
        <ButtonsFormDeleteButton
          buttonText="Refund"
          :disabled="useTransactionsStore().form.isLoading"
          @click="useTransactionsStore().deleteTransaction()"
        />
        <ButtonsFormSubmitButton
          buttonText="Save"
          :disabled="useTransactionsStore().form.isLoading"
        />
      </div>
    </form>
  </div>
</template>
