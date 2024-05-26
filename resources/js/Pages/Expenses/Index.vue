<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DateFilters from '@/Pages/Expenses/Partials/DateFilters.vue';
import ExpenseBanner from '@/Pages/Expenses/Partials/ExpenseBanner.vue';
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <DateFilters />

      <div class="space-y-6 py-8">
        <ExpenseBanner />
        <ExpenseBanner />
        <ExpenseBanner />
        <ExpenseBanner />
        <ExpenseBanner />
      </div>
    </div>
  </MainLayout>
</template>
