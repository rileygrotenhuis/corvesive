<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodSavingRequest } from '~/http/requests/savings.request';
import type { ISavingResource } from '~/http/resources/savings.resource';

const accountStore = useAccountStore();
const savingStore = useSavingStore();
const modalStore = useModalStore();

await savingStore.getSavings();

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
      <UFormGroup label="Saving" name="saving_id">
        <USelect v-model="selectedSaving" :options="savingOptions" />
      </UFormGroup>
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
