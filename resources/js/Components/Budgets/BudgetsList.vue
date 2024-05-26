<script setup>
import BudgetItem from './BudgetItem.vue';

defineProps({
  budgets: Array,
});
</script>

<template>
  <ul v-if="budgets.length > 0" class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="budget in budgets" :key="budget.id">
      <BudgetItem :budget="budget" />
    </li>
  </ul>
  <div v-else>
    <p class="mx-auto w-96 text-center">
      Create a new Budget entry to track your spending in a specific category
      over a period of time
    </p>
  </div>
</template>
