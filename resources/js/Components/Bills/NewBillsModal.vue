<script setup>
import Modal from '@/Components/Modal.vue';
import NewBillsForm from '@/Components/Bills/NewBillsForm.vue';
import useBillsStore from '@/store/bills';

const billsStore = useBillsStore();
</script>

<template>
  <Modal
    :show="billsStore.newBillsFormOpen"
    @close="billsStore.setNewBillsFormOpen(false)"
  >
    <NewBillsForm />
  </Modal>
</template>
