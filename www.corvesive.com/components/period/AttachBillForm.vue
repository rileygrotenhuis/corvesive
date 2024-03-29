<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodBillRequest } from '~/http/requests/bills.request';
import type { IBillResource } from '~/http/resources/bills.resource';

const accountStore = useAccountStore();
const billStore = useBillStore();
const modalStore = useModalStore();

await billStore.getBills(true);

const billOptions = computed(() => {
  return billStore.bills.map((bill: IBillResource) => {
    return {
      label: `${bill.issuer} - ${bill.name} (${bill.amount.pretty})`,
      value: bill.id,
    };
  });
});

const selectedBill: Ref<number> = ref(0);

const form: IAttachOrUpdatePayPeriodBillRequest = reactive({
  amount: 0,
  due_date: '',
  is_automatic: false,
});

const errors = ref();

const handleSubmit = async () => {
  form.amount = form.amount * 100;

  const response = await useNuxtApp().$api.bills.attachBillToPayPeriod(
    accountStore.user.pay_period.id,
    selectedBill.value,
    form
  );

  if (!(errors.value = response.errors)) {
    modalStore.closePeriodModal();
    await billStore.getPayPeriodBills(accountStore.user.pay_period.id, true);
  }
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-fuchsia-500">Attach Bill to Period</h4>
      <UFormGroup label="Select one of your recurring Bills" name="bill_id">
        <USelect v-model="selectedBill" :options="billOptions" />
      </UFormGroup>
      <UDivider />
      <p class="text-sm font-bold">Then fill in the relative details</p>
      <UFormGroup label="Due Date" name="due_date">
        <UInput v-model="form.due_date" type="date" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Is this bill automatic?" name="is_automatic">
        <UCheckbox :v-model="Boolean(form.is_automatic)" />
      </UFormGroup>
      <UButton type="submit" color="fuchsia"> Attach </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
