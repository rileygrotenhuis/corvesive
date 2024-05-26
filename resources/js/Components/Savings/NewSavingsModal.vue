<script setup>
import Modal from '@/Components/Modal.vue';
import NewSavingsForm from '@/Components/Savings/NewSavingsForm.vue';
import useSavingsStore from '@/store/savings';

const savingsStore = useSavingsStore();
</script>

<template>
  <Modal
    :show="savingsStore.newSavingsFormOpen"
    @close="savingsStore.setNewSavingsFormOpen(false)"
  >
    <NewSavingsForm />
  </Modal>
</template>
