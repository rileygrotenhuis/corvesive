<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
import PayPeriodSavingForm from '@/Pages/PayPeriods/Partials/PayPeriodSavingForm.vue';

const props = defineProps({
  savings: Array,
  currentSavings: Array,
});

const getCurrentSaving = (savingId) => {
  return props.currentSavings.find((saving) => saving.id === savingId);
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
        <PayPeriodSavingForm
          v-for="(saving, index) in savings"
          :key="index"
          :saving="saving"
          :currentSaving="getCurrentSaving(saving.id)"
        />
      </div>
    </div>
  </AuthenticatedLayout>
</template>
