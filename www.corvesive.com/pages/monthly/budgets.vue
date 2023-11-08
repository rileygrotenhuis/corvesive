<script setup lang="ts">
import useBudgetsStore from '~/stores/budgets.js';
import BudgetsIcon from '~/components/icons/BudgetsIcon.vue';
import copy from '~/libs/locales/copy.ts';

useHead({
  title: 'Corvesive - Budgets',
});

definePageMeta({
  layout: 'monthly',
});

await useBudgetsStore().getBudgets();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="BudgetsIcon"
      title="Budgets"
      :subtext="copy['monthly']['budgets']"
      buttonColor="bg-blue-500"
      modalKey="budgets.create"
    />
    <BudgetsMonthlyBudgetsTable class="mt-8 mb-4" />
  </div>
</template>
