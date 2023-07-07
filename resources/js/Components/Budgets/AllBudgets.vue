<script setup>
import BudgetItem from './BudgetItem.vue';

defineProps({
  budgets: Object,
});
</script>
<template>
  <ul class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="budget in budgets" :key="budget.id">
      <BudgetItem :budget="budget" />
    </li>
  </ul>
</template>
