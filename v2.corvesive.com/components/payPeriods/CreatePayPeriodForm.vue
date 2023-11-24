<script setup lang="ts">
import type { ICreateOrUpdatePayPeriodRequest } from '~/http/requests/payPeriods.request';

const payPeriodStore = usePayPeriodStore();
const modalStore = useModalStore();

const form: ICreateOrUpdatePayPeriodRequest = reactive({
  start_date: '',
  end_date: '',
});

const autoGenerateResources: Ref<boolean> = ref(false);

const errors = ref();

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.payPeriods.createPayPeriod(
    autoGenerateResources.value,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePayPeriodModal();
    await payPeriodStore.getPayPeriods();
    useToast().add({
      title:
        'You have created a new Pay Period. Select it in the Pay Period Menu to continue.',
    });
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">New Pay Period</h4>
      <p class="text-sm font-light">
        Magnify your budgeting to smaller segments of time with Pay Periods.
      </p>
      <UFormGroup label="Start Date" name="start_date">
        <UInput v-model="form.start_date" type="date" />
      </UFormGroup>
      <UFormGroup label="End Date" name="end_date">
        <UInput v-model="form.end_date" type="date" />
      </UFormGroup>
      <UFormGroup
        label="Would you like to auto generate your period resources?"
        name="auto_generate"
      >
        <UCheckbox v-model="autoGenerateResources" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Create </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
