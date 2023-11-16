<script setup lang="ts">
import type { ICreateOrUpdateBillRequest } from '~/http/requests/bills.request';

const billStore = useBillStore();
const modalStore = useModalStore();

const form: ICreateOrUpdateBillRequest = reactive({
  issuer: '',
  name: '',
  amount: 0,
  due_date: '',
  is_automatic: false,
  notes: '',
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.bills.createBill(form);

  if (!(errors.value = response.errors)) {
    await billStore.getBills();
    modalStore.closeRecurringModal();
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">New Bill</h4>
      <UFormGroup label="Issuer" name="issuer">
        <UInput v-model="form.issuer" />
      </UFormGroup>
      <UFormGroup label="Name" name="name">
        <UInput v-model="form.name" />
      </UFormGroup>
      <UFormGroup label="Due Date" name="due_date">
        <UInput v-model="form.due_date" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Notes" name="notes">
        <UTextarea v-model="form.notes" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Create </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
