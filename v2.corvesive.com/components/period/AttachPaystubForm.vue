<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodPaystubRequest } from '~/http/requests/paystubs.request';
import type { IPaystubResource } from '~/http/resources/paystubs.resource';

const accountStore = useAccountStore();
const paystubStore = usePaystubStore();
const modalStore = useModalStore();

onMounted(async () => {
  await paystubStore.getPaystubs();
});

const paystubOptions = computed(() => {
  return paystubStore.paystubs.map((paystub: IPaystubResource) => {
    return {
      label: `${paystub.issuer} - ${paystub.amount.pretty}`,
      value: paystub.id,
    };
  });
});

const selectedPaystub: Ref<number> = ref(0);

const form: IAttachOrUpdatePayPeriodPaystubRequest = reactive({
  amount: 0,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.paystubs.attachPaystubToPayPeriod(
    accountStore.user.pay_period.id,
    selectedPaystub.value,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePeriodModal();
    await paystubStore.getPayPeriodPaystubs(accountStore.user.pay_period.id);
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">Attach Paystub</h4>
      <p class="text-sm font-light">
        Attach on of your Paystubs to the currently selected Pay Period
      </p>
      <UFormGroup label="Paystub" name="paystub_id">
        <USelect v-model="selectedPaystub" :options="paystubOptions" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Attach </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
