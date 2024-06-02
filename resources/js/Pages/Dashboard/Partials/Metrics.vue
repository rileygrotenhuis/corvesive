<script setup>
import { computed } from 'vue';

const props = defineProps({
  expenses: Object,
  paystubs: Object,
});

const expensePercentage = computed(() => {
  return (props.expenses.paid / props.expenses.total) * 100;
});

const paystubPercentage = computed(() => {
  return (props.paystubs.deposited / props.paystubs.total) * 100;
});
</script>

<template>
  <div class="w-full md:w-1/3 bg-white p-4 rounded-md text-black space-y-4">
    <!-- Expense Metrics -->
    <div>
      <h4 class="text-lg font-semibold text-primary-700">Expenses</h4>

      <div>
        <span class="text-base text-gray-500">
          ${{ (expenses.paid / 100).toFixed(2) }}
        </span>
        <span class="text-base text-primary-700">
          / ${{ (expenses.total / 100).toFixed(2) }}
        </span>
      </div>

      <!-- Progress Bar -->
      <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
        <div
          class="h-full bg-primary-700 rounded-full"
          :style="{ width: `${expensePercentage}%` }"
        ></div>
      </div>
    </div>

    <!-- Paystub Metrics -->
    <div>
      <h4 class="text-lg font-semibold text-primary-700">Paystubs</h4>

      <div>
        <span class="text-base text-gray-500">
          ${{ (paystubs.deposited / 100).toFixed(2) }}
        </span>
        <span class="text-base text-primary-700">
          / ${{ (paystubs.total / 100).toFixed(2) }}
        </span>
      </div>

      <!-- Progress Bar -->
      <div class="w-full h-2 bg-gray-200 rounded-full mt-2">
        <div
          class="h-full bg-primary-700 rounded-full"
          :style="{ width: `${paystubPercentage}%` }"
        ></div>
      </div>
    </div>
  </div>
</template>
