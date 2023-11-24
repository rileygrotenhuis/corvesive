<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodBillRequest } from '~/http/requests/bills.request';

const accountStore = useAccountStore();
const billStore = useBillStore();
const modalStore = useModalStore();

const form: IAttachOrUpdatePayPeriodBillRequest = reactive({
  amount: modalStore.settings.data.amount.input,
  due_date: modalStore.settings.data.dates.due.raw,
  is_automatic: modalStore.settings.data.is_automatic,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.bills.updatePayPeriodBill(
    accountStore.user.pay_period.id,
    modalStore.settings.data.id,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closeSettingsModal();
    await billStore.getPayPeriodBills(accountStore.user.pay_period.id);
  }
};

const detachPayPeriodBill = async () => {
  const response = await useNuxtApp().$api.bills.detachBillFromPayPeriod(
    accountStore.user.pay_period.id,
    modalStore.settings.data.id
  );

  if (!(errors.value = response.errors)) {
    modalStore.closeSettingsModal();
    await billStore.getPayPeriodBills(accountStore.user.pay_period.id);
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">
        {{ modalStore.settings.data.bill.issuer }} -
        {{ modalStore.settings.data.bill.name }}
      </h4>
      <p class="text-sm font-bold">Update the details below...</p>
      <UFormGroup label="Due Date" name="due_date">
        <UInput v-model="form.due_date" type="date" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Is this bill automatic?" name="is_automatic">
        <UCheckbox :v-model="Boolean(form.is_automatic)" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Save </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
