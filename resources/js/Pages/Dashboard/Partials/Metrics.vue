<script setup>
import { computed } from 'vue';

const props = defineProps({
  expenses: Object,
  paystubs: Object,
});

const expensesPaid = computed(() => {
  return (props.expenses.paid / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const expensesTotal = computed(() => {
  return (props.expenses.total / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const paystubsDeposited = computed(() => {
  return (props.paystubs.deposited / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const paystubsTotal = computed(() => {
  return (props.paystubs.total / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const expensePercentage = computed(() => {
  return (props.expenses.paid / props.expenses.total) * 100;
});

const paystubPercentage = computed(() => {
  return (props.paystubs.deposited / props.paystubs.total) * 100;
});
</script>

<template>
  <div class="w-full bg-white p-4 rounded-md text-black">
    <h3 class="text-xl font-semibold text-black mb-2">This Month</h3>

    <!-- Expense Metrics -->
    <div class="mb-4">
      <h4 class="text-lg font-semibold text-primary-700">Expenses</h4>

      <div>
        <span class="text-base text-gray-500">
          {{ expensesPaid }}
        </span>
        <span class="text-base text-primary-700"> / {{ expensesTotal }} </span>
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
          {{ paystubsDeposited }}
        </span>
        <span class="text-base text-primary-700"> / {{ paystubsTotal }} </span>
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
