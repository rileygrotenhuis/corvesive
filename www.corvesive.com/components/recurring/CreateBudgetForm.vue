<script setup lang="ts">
import type { ICreateOrUpdateBudgetRequest } from '~/http/requests/budgets.request';

const budgetStore = useBudgetStore();
const modalStore = useModalStore();

const form: ICreateOrUpdateBudgetRequest = reactive({
  name: '',
  amount: 0,
  notes: '',
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.budgets.createBudget(form);

  if (!(errors.value = response.errors)) {
    await budgetStore.getBudgets(true);
    modalStore.closeRecurringModal();
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-fuchsia-500">New Budget</h4>
      <p class="text-sm font-light">
        Structure your budget categories for periodic withdrawals
      </p>
      <UFormGroup label="Name" name="name">
        <UInput v-model="form.name" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Notes" name="notes">
        <UTextarea v-model="form.notes" />
      </UFormGroup>
      <UButton type="submit" color="fuchsia"> Create </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
