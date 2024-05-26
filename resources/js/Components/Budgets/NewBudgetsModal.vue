<script setup>
import Modal from '@/Components/Modal.vue';
import NewBudgetsForm from '@/Components/Budgets/NewBudgetsForm.vue';
import useBudgetsStore from '@/store/budgets';

const budgetsStore = useBudgetsStore();
</script>

<template>
  <Modal
    :show="budgetsStore.newBudgetsFormOpen"
    @close="budgetsStore.setNewBudgetsFormOpen(false)"
  >
    <NewBudgetsForm />
  </Modal>
</template>
