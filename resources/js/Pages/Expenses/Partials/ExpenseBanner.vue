<script setup>
import { computed } from 'vue';
import PaidIcon from '@/Components/Icons/PaidIcon.vue';

const props = defineProps({
  expense: Object,
});

const isBill = computed(() => {
  return props.expense.type === 'Bill';
});

const isDueExpense = computed(() => {
  return props.expense?.monthYear;
});

const amount = computed(() => {
  return props.expense.amount.toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const expenseUrl = computed(() => {
  if (isDueExpense.value) {
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
      <div class="flex justify-between items-center gap-1">
        <div>
          <h2
            class="text-base md:text-xl font-bold text-gray-800 flex items-center gap-2"
          >
            {{ expense.name }}
            <span v-if="expense.isPaid">
              <PaidIcon />
            </span>
          </h2>
          <h4 class="text-sm font-medium text-gray-600">
            {{ expense?.issuer ?? `Monthly ${expense.type}` }}
          </h4>
        </div>

        <div class="text-right">
          <p class="text-2xl font-bold text-primary-700">
            {{ amount }}
          </p>
          <p
            v-if="isBill"
            class="text-base md:text-md font-medium text-gray-500"
          >
            Due: {{ expense.date }}
          </p>
        </div>
      </div>

      <div class="mt-4 text-gray-700 text-md">
        {{ expense.notes }}
      </div>
    </a>
  </div>
</template>
