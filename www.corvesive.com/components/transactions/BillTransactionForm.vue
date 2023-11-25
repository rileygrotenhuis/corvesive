<script setup lang="ts">
const accountStore = useAccountStore();
const billStore = useBillStore();
const modalStore = useModalStore();

const payPeriodBillOptions = (
  await billStore.getPayPeriodBills(accountStore.user.pay_period.id, true)
).map((payPeriodBill) => {
  return {
    label: `${payPeriodBill.bill.issuer} ${payPeriodBill.bill.name} (${payPeriodBill.amount.pretty})`,
    value: payPeriodBill.id,
    disabled: payPeriodBill.has_payed,
  };
});

const selectedPayPeriodBill: Ref<number> = ref(0);

const errors = ref();

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.transactions.billTransaction(
    accountStore.user.pay_period.id,
    selectedPayPeriodBill.value
  );

  if (!(errors.value = response.errors)) {
    modalStore.closeTransactionsModal();
    window.location.reload();
  }
};
</script>

<template>
  <div>
    <div class="space-y-4">
      <h4 class="text-xl font-bold text-fuchsia-500">Bill Payments</h4>
      <p class="text-sm font-light">
        Pay off one of your bills for the currently selected pay period!
      </p>
      <USelect
        :options="payPeriodBillOptions"
        v-model="selectedPayPeriodBill"
      />
      <UButton @click.prevent="handleSubmit" color="fuchsia"> Pay </UButton>
      <FormsFormErrors :errors="errors" />
    </div>
  </div>
</template>
