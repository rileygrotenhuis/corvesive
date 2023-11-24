<script setup lang="ts">
import type { ICreateOrUpdatePayPeriodRequest } from '~/http/requests/payPeriods.request';

const accountStore = useAccountStore();
const payPeriodStore = usePayPeriodStore();
const modalStore = useModalStore();

const form: ICreateOrUpdatePayPeriodRequest = reactive({
  start_date: accountStore.user.pay_period.dates.start.pretty.input,
  end_date: accountStore.user.pay_period.dates.end.pretty.input,
});

const errors = ref();

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.payPeriods.updatePayPeriod(
    accountStore.user.pay_period.id,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePayPeriodModal();
    await payPeriodStore.getPayPeriods();
    useToast().add({
      title: 'You have updated your current Pay Period',
    });
  }
};

const deletePayPeriod = async () => {
  await useNuxtApp().$api.payPeriods.deletePayPeriod(
    accountStore.user.pay_period.id
  );
  modalStore.closePayPeriodModal();
  await payPeriodStore.getPayPeriods();
  useToast().add({
    title: 'You have deleted your current Pay Period',
  });
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">
        Current Pay Period Settings
      </h4>
      <p class="text-sm font-light">
        Magnify your budgeting to smaller segments of time with Pay Periods.
      </p>
      <UFormGroup label="Start Date" name="start_date">
        <UInput v-model="form.start_date" type="date" />
      </UFormGroup>
      <UFormGroup label="End Date" name="end_date">
        <UInput v-model="form.end_date" type="date" />
      </UFormGroup>
      <div class="flex gap-2">
        <UButton @click="deletePayPeriod" variant="outline" color="rose">
          Delete Pay Period
        </UButton>
        <UButton type="submit" color="rose"> Save </UButton>
      </div>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
