<script setup>
import BillsIcon from "~/components/icons/BillsIcon.vue";
import copy from "~/libs/locales/copy.js";
import usePayPeriodBillsStore from "~/stores/payPeriodBills.js";

useHead({
  title: "Corvesive - Pay Period Expenses",
});

definePageMeta({
  layout: "dashboard",
});

await usePayPeriodBillsStore().getPayPeriodBills();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="BillsIcon"
      title="Bills"
      :subtext="copy['payPeriod']['bills']"
      buttonColor="bg-green-500"
      modalKey="payPeriods.bills.attach"
    />
    <div class="flex flex-col gap-16 mt-8">
      <BillsPayPeriodBillsTable />
    </div>
  </div>
</template>
