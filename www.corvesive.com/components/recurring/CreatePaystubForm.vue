<script setup lang="ts">
import type { ICreateOrUpdatePaystubRequest } from '~/http/requests/paystubs.request';

const paystubStore = usePaystubStore();
const modalStore = useModalStore();

const form: ICreateOrUpdatePaystubRequest = reactive({
  issuer: '',
  type: '',
  amount: 0,
  notes: '',
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.paystubs.createPaystub(form);

  if (!(errors.value = response.errors)) {
    await paystubStore.getPaystubs(true);
    modalStore.closeRecurringModal();
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">New Paystub</h4>
      <p class="text-sm font-light">Add a new source of income</p>
      <UFormGroup label="Issuer" name="issuer">
        <UInput v-model="form.issuer" />
      </UFormGroup>
      <UFormGroup label="Type" name="type">
        <UInput v-model="form.type" />
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
