<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import PayPeriodPaystubForm from '@/Pages/PayPeriods/Partials/PayPeriodPaystubForm.vue';

const props = defineProps({
  paystubs: Array,
  currentPaystubs: Array,
});

const getCurrentPaystub = (paystubId) => {
  return props.currentPaystubs.find((paystub) => paystub.id === paystubId);
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
        <PayPeriodPaystubForm
          v-for="(paystub, index) in paystubs"
          :key="index"
          :paystub="paystub"
          :currentPaystub="getCurrentPaystub(paystub.id)"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
