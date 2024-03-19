<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import IncomeHeader from '@/Pages/Income/Partials/IncomeHeader.vue';
import IncomeBreakdownCard from '@/Pages/Income/Partials/IncomeBreakdownCard.vue';
import IncomeBreakdownChart from '@/Pages/Income/Partials/IncomeBreakdownChart.vue';

const props = defineProps({
  card: Object,
  chart: Object,
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
      <IncomeBreakdownCard :data="card" />
      <IncomeBreakdownChart :chart="chart" />
    </div>
  </AuthenticatedLayout>
</template>
