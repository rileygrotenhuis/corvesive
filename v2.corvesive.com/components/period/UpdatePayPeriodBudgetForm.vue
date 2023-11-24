<script setup lang="ts">
import type { IUpdatePayPeriodBudgetRequest } from '~/http/requests/budgets.request';

const accountStore = useAccountStore();
const budgetStore = useBudgetStore();
const modalStore = useModalStore();

const form: IUpdatePayPeriodBudgetRequest = reactive({
  total_balance: modalStore.settings.data.total_balance.input,
  remaining_balance: modalStore.settings.data.remaining_balance.input,
});

const errors = ref();

const handleSubmit = async () => {
  form.total_balance = form.total_balance * 100;
  form.remaining_balance = form.remaining_balance * 100;

  const response = await useNuxtApp().$api.budgets.updatePayPeriodBudget(
    accountStore.user.pay_period.id,
    modalStore.settings.data.id,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closeSettingsModal();
    await budgetStore.getPayPeriodBudgets(accountStore.user.pay_period.id);
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">
        {{ modalStore.settings.data.budget.name }}
      </h4>
      <p class="text-sm font-bold">Update the details below...</p>
      <UFormGroup label="Total Balance" name="total_balance">
        <UInput v-model="form.total_balance" />
      </UFormGroup>
      <UFormGroup label="Remaining Balance" name="remaining_balance">
        <UInput v-model="form.remaining_balance" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Save </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
