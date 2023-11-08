<script setup>
import { ref, watch } from "vue";
import usePaystubsStore from "~/stores/paystubs";
import usePayPeriodsStore from "~/stores/payPeriods";
import usePayPeriodPaystubsStore from "~/stores/payPeriodPaystubs";

const selectedPaystub = ref(undefined);
watch(selectedPaystub, (newValue) => {
  usePayPeriodPaystubsStore().populateFormFields(
    usePayPeriodsStore().currentPayPeriod.id,
    newValue.id,
    newValue.amount.raw,
  );
});

const isPaystubDisabled = (paystubId) => {
  return usePayPeriodPaystubsStore().payPeriodPaystubs.some(
    (paystub) => paystub["paystub"]["id"] === paystubId,
  );
};
</script>

<template>
  <select
    v-model="selectedPaystub"
    class="shadow border rounded w-full py-2 pl-2 pr-16 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
  >
    <option
      v-for="paystub in usePaystubsStore().paystubs"
      :key="paystub.id"
      :value="paystub"
      :disabled="isPaystubDisabled(paystub.id)"
    >
      {{ paystub.issuer }} - {{ paystub.amount.pretty }}
    </option>
  </select>
</template>
