<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import MonthlyExpenseBreakdownChart from '@/Pages/Expenses/Partials/MonthlyExpenseBreakdownChart.vue';
import MonthlyExpenseBreakdownCard from '@/Pages/Expenses/Partials/MonthlyExpenseBreakdownCard.vue';
import MonthlyExpenseHeader from '@/Pages/Expenses/Partials/MonthlyExpenseHeader.vue';

const props = defineProps({
  monthlyExpenseBreakdown: Object,
});
</script>

<template>
  <Head title="Monthly Expenses" />

  <AuthenticatedLayout>
    <template #header>
      <MonthlyExpenseHeader />
    </template>

    <div
      class="py-12 flex flex-col md:flex-row justify-center items-center gap-12"
    >
      <MonthlyExpenseBreakdownCard
        :monthlyExpenseBreakdown="monthlyExpenseBreakdown"
      />
      <MonthlyExpenseBreakdownChart
        :monthlyExpenseBreakdown="monthlyExpenseBreakdown"
      />
    </div>
  </AuthenticatedLayout>
</template>
