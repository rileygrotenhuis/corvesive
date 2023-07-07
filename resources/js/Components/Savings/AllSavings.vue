<script setup>
import Modal from '@/Components/Modal.vue';
import SavingItem from './SavingItem.vue';
import NewSavingsForm from '@/Components/Savings/NewSavingsForm.vue';
import useSavingsStore from '@/store/savings';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const savingsStore = useSavingsStore();

defineProps({
  savings: Object,
});
</script>
<template>
  <Modal
    :show="savingsStore.newSavingsFormOpen"
    @close="savingsStore.setNewSavingsFormOpen(false)"
  >
    <NewSavingsForm />
  </Modal>
  <ul class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="saving in savings" :key="saving.id">
      <SavingItem :saving="saving" />
    </li>
  </ul>
  <div class="mx-auto mt-4 w-fit">
    <PrimaryButton @click="savingsStore.setNewSavingsFormOpen(true)">
      + Savings
    </PrimaryButton>
  </div>
</template>
