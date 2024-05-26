<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DateFilters from '@/Pages/Expenses/Partials/DateFilters.vue';
import ExpenseBanner from '@/Pages/Expenses/Partials/ExpenseBanner.vue';

defineProps({
  expenses: Object,
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <DateFilters />

      <div class="space-y-6 py-8">
        <ExpenseBanner
          v-for="expense in expenses.all"
          :key="expense.id"
          :issuer="expense.issuer"
          :name="expense.name"
          :amount="expense.amount"
          :dueDate="expense.due_day"
          :notes="expense.notes"
        />
      </div>
    </div>
  </MainLayout>
</template>
