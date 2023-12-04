<script setup lang="ts">
const recurringStore = useRecurringStore();
</script>

<template>
  <div class="space-y-4">
    <div>
      <h4>Income</h4>
      <ul class="list-disc ml-4">
        <li>
          Total Paystubs: {{ recurringStore.metrics.income.paystubs.pretty }}
        </li>
      </ul>
    </div>
    <div>
      <h4>Expenses</h4>
      <ul class="list-disc ml-4">
        <li>Bills: {{ recurringStore.metrics.expenses.bills.pretty }}</li>
        <li>Budgets: {{ recurringStore.metrics.expenses.budgets.pretty }}</li>
        <li>Savings: {{ recurringStore.metrics.expenses.savings.pretty }}</li>
        <li>Total: {{ recurringStore.metrics.expenses.total.pretty }}</li>
      </ul>
    </div>
    <div>
      <h4>Surplus:</h4>
      <ul class="list-disc ml-4">
        <li>
          Projected Surplus:
          {{ recurringStore.metrics.surplus.projected.pretty }}
        </li>
      </ul>
    </div>
  </div>
</template>
