<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import PayPeriodBillForm from '@/Pages/PayPeriods/Partials/PayPeriodBillForm.vue';

const props = defineProps({
  bills: Array,
  currentBills: Array,
});

const getCurrentBill = (billId) => {
  return props.currentBills.find((bill) => bill.id === billId);
};
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <PayPeriodsHeader />
    </template>

    <div class="py-12">
      <div class="space-y-6">
        <PayPeriodBillForm
          v-for="(bill, index) in bills"
          :key="index"
          :bill="bill"
          :currentBill="getCurrentBill(bill.id)"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
