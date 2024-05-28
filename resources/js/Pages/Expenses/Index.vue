<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DateFilters from '@/Pages/Expenses/Partials/DateFilters.vue';
import ExpenseBanner from '@/Pages/Expenses/Partials/ExpenseBanner.vue';
import { computed, ref } from 'vue';

const props = defineProps({
  expenses: Object,
});

const selectedDateRange = ref('all');

const selectedExpenses = computed(() => {
  return props.expenses[selectedDateRange.value];
});

const noExpenseFoundMessage = computed(() => {
  const snippet =
    selectedDateRange.value === 'all' ? '' : selectedDateRange.value;

  return `No expenses ${snippet} found.`;
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
          v-if="selectedExpenses.length > 0"
          v-for="expense in selectedExpenses"
          :key="expense.id"
          :expense="expense"
        />

        <div v-else>
          <p class="text-primary-100 font-bold">
            {{ noExpenseFoundMessage }}
          </p>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
