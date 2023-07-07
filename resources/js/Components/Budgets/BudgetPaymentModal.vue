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
    <BudgetPaymentForm />
  </Modal>
</template>
