<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodSavingRequest } from '~/http/requests/savings.request';

const accountStore = useAccountStore();
const savingStore = useSavingStore();
const modalStore = useModalStore();

const selectedSaving: Ref<number> = ref(0);

const form: IAttachOrUpdatePayPeriodSavingRequest = reactive({
  amount: 0,
});

const errors = ref();

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.savings.attachSavingToPayPeriod(
    accountStore.user.pay_period.id,
    selectedSaving.value,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePeriodModal();
    await savingStore.getPayPeriodSavings(accountStore.user.pay_period.id);
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">Attach Saving</h4>
      <p class="text-sm font-light">
        Attach on of your Savings to the currently selected Pay Period
      </p>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UButton type="submit" color="rose" :disabled="selectedSaving === 0">
        Attach
      </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
