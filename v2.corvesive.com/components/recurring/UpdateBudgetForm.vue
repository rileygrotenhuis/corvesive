<script setup lang="ts">
import type { ICreateOrUpdateBudgetRequest } from '~/http/requests/budgets.request';

const accountStore = useAccountStore();
const budgetStore = useBudgetStore();
const modalStore = useModalStore();

const form: ICreateOrUpdateBudgetRequest = reactive({
  name: modalStore.settings.data.name,
  amount: modalStore.settings.data.amount.input,
  notes: modalStore.settings.data.notes,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.budgets.updateBudget(
    modalStore.settings.data.id,
    form
  );

  if (!(errors.value = response.errors)) {
    await budgetStore.getBudgets();
    modalStore.closeSettingsModal();
  }
};

const deleteBudget = async () => {
  if (window.confirm('Are you sure you want to delete this budget?')) {
    await useNuxtApp().$api.budgets.deleteBudget(modalStore.settings.data.id);
    await budgetStore.getBudgets();
    await budgetStore.getPayPeriodBudgets(accountStore.user.pay_period.id);
    modalStore.closeSettingsModal();
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">
        {{ modalStore.settings.data.name }}
      </h4>
      <p class="text-sm font-bold">Update the details below...</p>
      <UFormGroup label="Name" name="name">
        <UInput v-model="form.name" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Notes" name="notes">
        <UTextarea v-model="form.notes" />
      </UFormGroup>
      <div class="flex justify-between">
        <UButton @click="deleteBudget" variant="outline" color="rose">
          Delete Budget
        </UButton>
        <UButton type="submit" color="rose"> Save </UButton>
      </div>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
