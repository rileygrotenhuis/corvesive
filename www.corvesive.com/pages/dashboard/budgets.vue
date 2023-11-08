<script setup lang="ts">
import BudgetsIcon from '~/components/icons/BudgetsIcon.vue';
import copy from '~/libs/locales/copy.ts';
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets.ts';

useHead({
  title: 'Corvesive - Pay Period Expenses',
});

definePageMeta({
  layout: 'dashboard',
});

await usePayPeriodBudgetsStore().getPayPeriodBudgets();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="BudgetsIcon"
      title="Budgets"
      :subtext="copy['payPeriod']['budgets']"
      buttonColor="bg-blue-500"
      modalKey="payPeriods.budgets.attach"
    />
    <div class="flex flex-col gap-16 mt-8">
      <BudgetsPayPeriodBudgetsTable />
    </div>
  </div>
</template>
