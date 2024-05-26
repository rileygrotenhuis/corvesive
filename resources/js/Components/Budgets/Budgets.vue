<script setup>
import BudgetsList from '@/Components/Budgets/BudgetsList.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useBudgetsStore from '@/store/budgets';
import NewBudgetsModal from '@/Components/Budgets/NewBudgetsModal.vue';
import BudgetPaymentModal from '@/Components/Budgets/BudgetPaymentModal.vue';

const budgetsStore = useBudgetsStore();
defineProps({
  budgets: Object,
});
</script>
<template>
  <NewBudgetsModal />
  <BudgetPaymentModal />
  <BudgetsList :budgets="budgets" />
  <div class="mx-auto mt-4 w-fit">
    <PrimaryButton @click="budgetsStore.setNewBudgetsFormOpen(true)">
      + Budget
    </PrimaryButton>
  </div>
</template>
