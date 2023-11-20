<script setup lang="ts">
import type { IAttachPayPeriodBudgetRequest } from '~/http/requests/budgets.request';

const budgetStore = useBudgetStore();
const modalStore = useModalStore();

const form: IAttachPayPeriodBudgetRequest = reactive({
  total_balance: 0,
});

const errors = ref();

const handleSubmit = async () => {
  alert('testing');
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">Attach Budget</h4>
      <p class="text-sm font-light">
        Attach on of your Budgets to the currently selected Pay Period
      </p>
      <UFormGroup label="Total Balance" name="total_balance">
        <UInput v-model="form.total_balance" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Attach </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
