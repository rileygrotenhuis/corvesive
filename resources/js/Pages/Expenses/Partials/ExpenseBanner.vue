<script setup>
import { computed } from 'vue';

const props = defineProps({
  expense: Object,
});

const isBill = computed(() => {
  if (props.expense?.expense) {
    return props.expense.expense.type === 'Bill';
  }

  return props.expense.type === 'Bill';
});

const formattedExpense = computed(() => {
  return {
    id: props.expense.id,
    type: props.expense?.type ?? props.expense?.expense?.type ?? 'Unknown',
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
  if (props.expense?.expense) {
    return route('monthly-expenses.show', props.expense.id);
  }

  return route('expenses.show', props.expense.id);
});
</script>

<template>
  <div
    class="w-full bg-primary-100 hover:bg-primary-300 cursor-pointer text-black hover:shadow-lg border border-gray-200 p-6 rounded-xl transition-transform transform hover:scale-105 ease-in-out"
  >
    <a :href="expenseUrl">
      <div class="flex justify-between items-center">
        <div>
          <h2 class="text-xl font-bold text-gray-800">
            {{ formattedExpense.name }}
          </h2>
          <h4 class="text-sm font-medium text-gray-600">
            {{
              isBill
                ? formattedExpense.issuer
                : formattedExpense.type.toUpperCase()
            }}
          </h4>
        </div>

        <div class="text-right">
          <p class="text-2xl font-bold text-primary-700">
            ${{ formattedExpense.amount }}
          </p>
          <p v-if="isBill" class="text-md font-medium text-gray-500">
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
