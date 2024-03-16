<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import IncomeHeader from '@/Pages/Income/Partials/IncomeHeader.vue';

const props = defineProps({
  monthlyExpenseBreakdown: Object,
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
      <h1>Content will go here</h1>
    </div>
  </AuthenticatedLayout>
</template>
