<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodSavingRequest } from '~/http/requests/savings.request';
import type { ISavingResource } from '~/http/resources/savings.resource';

const accountStore = useAccountStore();
const savingStore = useSavingStore();
const modalStore = useModalStore();

await savingStore.getSavings(true);

const savingOptions = computed(() => {
  return savingStore.savings.map((saving: ISavingResource) => {
    return {
      label: `${saving.name} - ${saving.amount.pretty}`,
      value: saving.id,
    };
  });
});

const selectedSaving: Ref<number> = ref(0);

const form: IAttachOrUpdatePayPeriodSavingRequest = reactive({
  amount: 0,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.savings.attachSavingToPayPeriod(
    accountStore.user.pay_period.id,
    selectedSaving.value,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePeriodModal();
    await savingStore.getPayPeriodSavings(
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
        Attach Saving to Period
      </h4>
      <UFormGroup label="Select one of your recurring Savings" name="saving_id">
        <USelect v-model="selectedSaving" :options="savingOptions" />
      </UFormGroup>
      <UDivider />
      <p class="text-sm font-bold">Then fill in the relative details</p>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UButton type="submit" color="fuchsia" :disabled="selectedSaving === 0">
        Attach
      </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
