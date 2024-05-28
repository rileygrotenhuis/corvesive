<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DateFilters from '@/Pages/Expenses/Partials/DateFilters.vue';
import ExpenseBanner from '@/Pages/Expenses/Partials/ExpenseBanner.vue';
import { computed, ref } from "vue";

const props = defineProps({
  expenses: Object,
});

const selectedDateRange = ref('thisMonth');

const selectedExpenses = computed(() => {
  return props.expenses[selectedDateRange.value];
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <DateFilters
        :selectedDateRange="selectedDateRange"
        @updateSelectedDateFilter="selectedDateRange = $event"
      />

      <div class="space-y-6 py-8">
        <ExpenseBanner
          v-for="expense in selectedExpenses"
          :key="expense.id"
          :issuer="expense.expense.issuer"
          :name="expense.expense.name"
          :amount="expense.expense.amount"
          :dueDate="expense.due_day"
          :notes="expense.notes"
        />
      </div>
    </div>
  </MainLayout>
</template>
