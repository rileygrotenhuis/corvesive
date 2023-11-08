<script setup lang="ts">
import { ref, watch } from 'vue';
import useBillsStore from '~/stores/bills';
import usePayPeriodsStore from '~/stores/payPeriods';
import usePayPeriodBillsStore from '~/stores/payPeriodBills';

const selectedBill = ref(undefined);
watch(selectedBill, (newValue: Object) => {
  usePayPeriodBillsStore().populateFormFields(
    usePayPeriodsStore().currentPayPeriod.id,
    newValue.id,
    newValue.amount.raw,
    undefined
  );
});

const isBillDisabled = (billId) => {
  return usePayPeriodBillsStore().payPeriodBills.some(
    (bill) => bill['bill']['id'] === billId
  );
};
</script>

<template>
  <select
    v-model="selectedBill"
    class="shadow border rounded w-full py-2 pl-2 pr-16 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
  >
    <option
      v-for="bill in useBillsStore().bills"
      :key="bill.id"
      :value="bill"
      :disabled="isBillDisabled(bill.id)"
    >
      {{ bill.issuer }} - {{ bill.name }}
    </option>
  </select>
</template>
