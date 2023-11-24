<script setup lang="ts">
import type { ICreateOrUpdateBillRequest } from '~/http/requests/bills.request';

const billStore = useBillStore();
const modalStore = useModalStore();

const form: ICreateOrUpdateBillRequest = reactive({
  issuer: modalStore.settings.data.issuer,
  name: modalStore.settings.data.name,
  amount: modalStore.settings.data.amount.input,
  due_date: modalStore.settings.data.due_date.raw,
  is_automatic: modalStore.settings.data.is_automatic,
  notes: modalStore.settings.data.notes,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.bills.updateBill(
    modalStore.settings.data.id,
    form
  );

  if (!(errors.value = response.errors)) {
    await billStore.getBills();
    modalStore.closeSettingsModal();
  }
};

const deleteBill = async () => {
  await useNuxtApp().$api.bills.deleteBill(modalStore.settings.data.id);
  await billStore.getBills();
  modalStore.closeSettingsModal();
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">
        {{ modalStore.settings.data.issuer }} -
        {{ modalStore.settings.data.name }}
      </h4>
      <p class="text-sm font-bold">Update the details below...</p>
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
      <div class="flex gap-2">
        <UButton @click="deleteBill" variant="outline" color="rose">
          Delete Bill
        </UButton>
        <UButton type="submit" color="rose"> Save </UButton>
      </div>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
