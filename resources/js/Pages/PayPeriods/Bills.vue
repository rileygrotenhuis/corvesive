<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';

defineProps({
  unassignedBills: Array
});
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <PayPeriodsHeader />
    </template>

    <div class="py-12">
      <h1 class="text-white text-center">Bills Settings</h1>
      <div class="text-white font-bold">
        {{ JSON.stringify(unassignedBills) }}
      </div>
    </div>
  </AuthenticatedLayout>
</template>
