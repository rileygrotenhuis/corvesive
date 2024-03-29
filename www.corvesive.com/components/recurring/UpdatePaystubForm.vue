<script setup lang="ts">
import type { ICreateOrUpdatePaystubRequest } from '~/http/requests/paystubs.request';

const accountStore = useAccountStore();
const paystubStore = usePaystubStore();
const modalStore = useModalStore();

const form: ICreateOrUpdatePaystubRequest = reactive({
  issuer: modalStore.settings.data.issuer,
  type: modalStore.settings.data.type,
  amount: modalStore.settings.data.amount.input,
  notes: modalStore.settings.data.notes,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.paystubs.updatePaystub(
    modalStore.settings.data.id,
    form
  );

  if (!(errors.value = response.errors)) {
    await paystubStore.getPaystubs(true);
    modalStore.closeSettingsModal();
  }
};

const deletePaystub = async () => {
  if (window.confirm('Are you sure you want to delete this paystub?')) {
    await useNuxtApp().$api.paystubs.deletePaystub(modalStore.settings.data.id);
    await paystubStore.getPaystubs(true);
    await paystubStore.getPayPeriodPaystubs(
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
        {{ modalStore.settings.data.issuer }}
      </h4>
      <p class="text-sm font-bold">Update the details below...</p>
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
      <div class="flex justify-between">
        <UButton @click="deletePaystub" variant="outline" color="fuchsia">
          Delete Paystub
        </UButton>
        <UButton type="submit" color="fuchsia"> Save </UButton>
      </div>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
