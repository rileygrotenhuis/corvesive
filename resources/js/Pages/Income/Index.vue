<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import IncomeHeader from '@/Pages/Income/Partials/IncomeHeader.vue';

const props = defineProps({
  incomeBreakdown: Object,
});
</script>

<template>
  <Head title="Income" />

  <AuthenticatedLayout>
    <template #header>
      <IncomeHeader />
    </template>

    <div
      class="py-12 flex flex-col md:flex-row justify-center items-center gap-12"
    >
      {{ JSON.stringify(incomeBreakdown) }}
    </div>
  </AuthenticatedLayout>
</template>
