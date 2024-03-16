<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import IncomeHeader from '@/Pages/Income/Partials/IncomeHeader.vue';
import IncomeBreakdownCard from '@/Pages/Income/Partials/IncomeBreakdownCard.vue';

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
      <IncomeBreakdownCard :incomeBreakdown="incomeBreakdown" />
      n
      <div class="bg-gray-800 rounded-lg shadow-lg w-[350px]" />
    </div>
  </AuthenticatedLayout>
</template>
