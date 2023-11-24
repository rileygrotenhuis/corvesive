<script setup lang="ts">
import type { ICreateOrUpdateSavingRequest } from '~/http/requests/savings.request';

const savingStore = useSavingStore();
const modalStore = useModalStore();

const form: ICreateOrUpdateSavingRequest = reactive({
  name: modalStore.settings.data.name,
  amount: modalStore.settings.data.amount.input,
  notes: modalStore.settings.data.notes,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.savings.updateSaving(
    modalStore.settings.data.id,
    form
  );

  if (!(errors.value = response.errors)) {
    await savingStore.getSavings();
    modalStore.closeSettingsModal();
  }
};

const deleteSaving = async () => {
  const response = await useNuxtApp().$api.savings.deleteSaving(
    modalStore.settings.data.id
  );

  if (!(errors.value = response.errors)) {
    await savingStore.getSavings();
    modalStore.closeSettingsModal();
  }
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
      <UFormGroup label="Name" name="name">
        <UInput v-model="form.name" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Notes" name="notes">
        <UTextarea v-model="form.notes" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Save </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
