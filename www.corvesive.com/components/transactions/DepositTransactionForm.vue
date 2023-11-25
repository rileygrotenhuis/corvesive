<script setup lang="ts">
import type { IDeposiTransactionRequest } from '~/http/requests/transactions.request';

const accountStore = useAccountStore();
const transactionStore = useTransactionStore();
const modalStore = useModalStore();

const form: IDeposiTransactionRequest = reactive({
  amount: 0,
  notes: '',
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.transactions.payPeriodDeposit(
    accountStore.user.pay_period.id,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closeTransactionsModal();
    window.location.reload();
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-fuchsia-500">Make a Deposit</h4>
      <p class="text-sm font-light">
        Have some extra money that you'd like to track in this current period?
        Make a deposit to add to your total funds!
      </p>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Notes" name="notes">
        <UTextarea v-model="form.notes" />
      </UFormGroup>
      <UButton type="submit" color="fuchsia"> Deposit </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
