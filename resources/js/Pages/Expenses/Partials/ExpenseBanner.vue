<script setup>
import { computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const props = defineProps({
  expense: Object,
});

const formattedExpense = computed(() => {
  return {
    id: props.expense.id,
    issuer:
      props.expense?.issuer ?? props.expense?.expense?.issuer ?? 'Unknown',
    name: props.expense.name ?? props.expense.expense.name ?? 'Unknown',
    amount: props.expense?.amount ?? props.expense?.expense?.amount ?? '$0.00',
    dueDate:
      props.expense?.due_day ?? props.expense?.expense?.due_day ?? 'Unknown',
    notes: props.expense?.notes ?? props.expense?.expense?.notes ?? '',
  };
});

const expenseUrl = computed(() => {
  // TODO: Monthly Expense Show
  if (props.expense?.expense) {
    return '#';
  }

  // TODO: Expense Show
  return '#';
});
</script>

<template>
  <div
    class="max-w-[750px] bg-primary-100 hover:bg-primary-300 cursor-pointer text-black cursor-pointer hover:shadow-lg border border-gray-200 p-6 rounded-xl transition-transform transform hover:scale-105 ease-in-out"
  >
    <a :href="expenseUrl">
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-xl font-bold text-gray-800">
            {{ formattedExpense.name }}
          </h2>
          <h4 class="text-md font-medium text-gray-600">
            {{ formattedExpense.issuer }}
          </h4>
        </div>

        <div class="text-right">
          <p class="text-2xl font-bold text-primary-700">
            ${{ formattedExpense.amount }}
          </p>
          <p class="text-md font-medium text-gray-500">
            Due: {{ formattedExpense.dueDate }}
          </p>
        </div>
      </div>

      <div class="mt-4 text-gray-700 text-md">
        {{ formattedExpense.notes }}
      </div>
    </a>
  </div>
</template>
