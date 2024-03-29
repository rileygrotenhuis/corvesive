<script setup lang="ts">
import type { IBudgetTransactionRequest } from '~/http/requests/transactions.request';

const accountStore = useAccountStore();
const transactionStore = useTransactionStore();
const budgetStore = useBudgetStore();
const modalStore = useModalStore();

const form: IBudgetTransactionRequest = reactive({
  amount: 0,
});

const payPeriodBudgetOptions = (
  await budgetStore.getPayPeriodBudgets(accountStore.user.pay_period.id, true)
).map((payPeriodBudget) => {
  return {
    label: `${payPeriodBudget.budget.name} (${payPeriodBudget.remaining_balance.pretty})`,
    value: payPeriodBudget.id,
  };
});

const selectedPayPeriodBudget: Ref<number> = ref(0);

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.transactions.budgetTransaction(
    accountStore.user.pay_period.id,
    selectedPayPeriodBudget.value,
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
    <div class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-fuchsia-500">Budget Payments</h4>
      <p class="text-sm font-light">
        Pay off one of your budgets for the currently selected pay period!
      </p>
      <USelect
        :options="payPeriodBudgetOptions"
        v-model="selectedPayPeriodBudget"
      />
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UButton @click.prevent="handleSubmit" color="fuchsia"> Pay </UButton>
      <FormsFormErrors :errors="errors" />
    </div>
  </div>
</template>
