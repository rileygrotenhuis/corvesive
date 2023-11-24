<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodPaystubRequest } from '~/http/requests/paystubs.request';

const accountStore = useAccountStore();
const paystubStore = usePaystubStore();
const modalStore = useModalStore();

const form: IAttachOrUpdatePayPeriodPaystubRequest = reactive({
  amount: modalStore.settings.data.amount.input,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.paystubs.updatePayPeriodPaystub(
    accountStore.user.pay_period.id,
    modalStore.settings.data.id,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closeSettingsModal();
    await paystubStore.getPayPeriodPaystubs(accountStore.user.pay_period.id);
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">
        {{ modalStore.settings.data.paystub.issuer }}
      </h4>
      <p class="text-sm font-bold">Update the details below...</p>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Save </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
