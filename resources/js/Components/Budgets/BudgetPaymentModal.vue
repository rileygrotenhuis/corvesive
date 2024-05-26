<script setup>
import Modal from '@/Components/Modal.vue';
import BudgetPaymentForm from '@/Components/Budgets/BudgetPaymentForm.vue';
import useBudgetsStore from '@/store/budgets';

const budgetsStore = useBudgetsStore();
</script>

<template>
  <Modal
    :show="budgetsStore.budgetPaymentFormOpen"
    @close="budgetsStore.setBudgetPaymentFormOpen(false)"
  >
    <div
      class="m-8 mx-auto flex w-fit flex-col items-center gap-4 px-8 text-center sm:flex-row"
    >
      <a
        :href="route('budgets.edit', [budgetsStore.currentBudget.id])"
        class="hover:cursor-pointer"
        >&#9881;</a
      >
      <h3 class="text-xl font-bold">
        {{ budgetsStore.currentBudget.name }} budget
      </h3>
    </div>
    <BudgetPaymentForm />
  </Modal>
</template>
