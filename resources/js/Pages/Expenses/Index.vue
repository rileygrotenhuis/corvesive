<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ExpenseBanner from '@/Pages/Expenses/Partials/ExpenseBanner.vue';
import ExpenseToggle from '@/Pages/Expenses/Partials/ExpenseToggle.vue';
import { ref } from 'vue';
import DateFilters from '@/Components/Filters/DateFilters.vue';

const props = defineProps({
  expenses: Array,
  monthlyExpenses: Object,
  monthSelectionOptions: Array,
});

const expenseToggle = ref('due');
const selectedMonth = ref(props.monthSelectionOptions[0]?.value ?? null);
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <div class="max-w-3xl">
        <div class="flex justify-between items-center">
          <ExpenseToggle
            :selectedOption="expenseToggle"
            @updateExpenseToggle="expenseToggle = $event"
          />

          <DateFilters
            :selectedMonth="selectedMonth"
            :monthSelectionOptions="monthSelectionOptions"
            @updateSelectedMonth="selectedMonth = $event"
          />

          <a
            :href="route('expenses.create')"
            class="w-8 h-8 flex text-center justify-center items-center bg-primary-100 p-2 text-primary-1000 font-bold rounded-full hover:bg-primary-700 hover:text-primary-100 transition ease-in-out"
          >
            +
          </a>
        </div>

        <div class="py-8">
          <div v-if="expenseToggle === 'all'" class="space-y-6">
            <ExpenseBanner
              v-if="expenses.length > 0"
              v-for="expense in expenses"
              :key="expense.id"
              :expense="expense"
            />

            <div v-else>
              <p class="text-primary-100 font-bold">No expenses found.</p>
            </div>
          </div>

          <div v-else class="space-y-6">
            <ExpenseBanner
              v-if="Object.keys(monthlyExpenses).length > 0"
              v-for="expense in monthlyExpenses[selectedMonth]"
              :key="expense.id"
              :expense="expense"
            />

            <div v-else>
              <p class="text-primary-100 font-bold">No expenses found.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
