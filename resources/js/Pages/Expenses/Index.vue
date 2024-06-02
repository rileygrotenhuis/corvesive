<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ExpenseBanner from '@/Pages/Expenses/Partials/ExpenseBanner.vue';
import ExpenseToggle from '@/Pages/Expenses/Partials/ExpenseToggle.vue';
import { computed, ref } from 'vue';
import DateFilters from '@/Components/Filters/DateFilters.vue';
import TypeFilters from '@/Pages/Expenses/Partials/TypeFilters.vue';

const props = defineProps({
  expenses: Array,
  monthlyExpenses: Object,
  monthSelectionOptions: Array,
});

const expenseToggle = ref('due');
const selectedMonth = ref(props.monthSelectionOptions[0]?.value ?? null);
const selectedType = ref('All');

const filteredExpenses = computed(() => {
  return props.expenses.filter((expense) => {
    if (selectedType.value === 'All') {
      return true;
    }

    return expense.type === selectedType.value;
  });
});

const filteredMonthlyExpenses = computed(() => {
  return (
    props?.monthlyExpenses[selectedMonth.value]?.filter((expense) => {
      if (selectedType.value === 'All') {
        return true;
      }

      return expense.type === selectedType.value;
    }) ?? []
  );
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <div class="w-full md:w-2/3">
        <div
          class="flex flex-wrap-reverse gap-4 justify-between md:items-center"
        >
          <div
            class="flex justify-between md:justify-center items-center gap-1 md:gap-4 w-full md:w-auto"
          >
            <ExpenseToggle
              :selectedOption="expenseToggle"
              @updateExpenseToggle="expenseToggle = $event"
            />

            <DateFilters
              :selectedMonth="selectedMonth"
              :monthSelectionOptions="monthSelectionOptions"
              @updateSelectedMonth="selectedMonth = $event"
            />
          </div>

          <div
            class="flex justify-between md:justify-center items-center gap-1 md:gap-4 w-full md:w-auto"
          >
            <TypeFilters
              :selectedType="selectedType"
              @updateSelectedType="selectedType = $event"
            />
            <a
              :href="route('expenses.create')"
              class="w-8 h-8 flex text-center justify-center items-center bg-primary-100 p-2 text-primary-1000 font-bold rounded-full hover:bg-primary-700 hover:text-primary-100 transition ease-in-out"
            >
              +
            </a>
          </div>
        </div>

        <div class="py-8">
          <div v-if="expenseToggle === 'all'" class="space-y-6">
            <ExpenseBanner
              v-if="filteredExpenses.length > 0"
              v-for="expense in filteredExpenses"
              :key="expense.id"
              :expense="expense"
            />

            <div v-else>
              <p class="text-primary-100 font-bold">No expenses found.</p>
            </div>
          </div>

          <div v-else class="space-y-6">
            <ExpenseBanner
              v-if="filteredMonthlyExpenses.length > 0"
              v-for="expense in filteredMonthlyExpenses"
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
