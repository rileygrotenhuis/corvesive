<script setup lang="ts">
import type { ICreateOrUpdateSavingRequest } from '~/http/requests/savings.request';

const accountStore = useAccountStore();
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
    await savingStore.getSavings(true);
    modalStore.closeSettingsModal();
  }
};

const deleteSaving = async () => {
  if (window.confirm('Are you sure you want to delete this saving?')) {
    await useNuxtApp().$api.savings.deleteSaving(modalStore.settings.data.id);
    await savingStore.getSavings(true);
    await savingStore.getPayPeriodSavings(
      accountStore.user.pay_period.id,
      true
    );
    modalStore.closeSettingsModal();
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-fuchsia-500">
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
        <UButton @click="deleteSaving" variant="outline" color="fuchsia">
          Delete Saving
        </UButton>
        <UButton type="submit" color="fuchsia"> Save </UButton>
      </div>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
