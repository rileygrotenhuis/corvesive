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
    modalStore.settings.data.paystub.id,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closeSettingsModal();
    await paystubStore.getPayPeriodPaystubs(
      accountStore.user.pay_period.id,
      true
    );
  }
};

const detachPayPeriodPaystub = async () => {
  if (
    window.confirm(
      'Are you sure you want to remove this paystub from the selected pay period?'
    )
  ) {
    await useNuxtApp().$api.paystubs.detachPaystubFromPayPeriod(
      accountStore.user.pay_period.id,
      modalStore.settings.data.paystub.id
    );
    modalStore.closeSettingsModal();
    await paystubStore.getPayPeriodPaystubs(
      accountStore.user.pay_period.id,
      true
    );
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-fuchsia-500">
        {{ modalStore.settings.data.paystub.issuer }}
      </h4>
      <p class="text-sm font-bold">Update the details below...</p>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <div class="flex justify-between">
        <UButton
          @click="detachPayPeriodPaystub"
          variant="outline"
          color="fuchsia"
        >
          Remove Paystub
        </UButton>
        <UButton type="submit" color="fuchsia"> Save </UButton>
      </div>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
