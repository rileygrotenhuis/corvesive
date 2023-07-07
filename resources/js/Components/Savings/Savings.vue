<script setup>
import NewSavingsModal from '@/Components/Savings/NewSavingsModal.vue';
import SavingsList from '@/Components/Savings/SavingsList.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useSavingsStore from '@/store/savings';

const savingsStore = useSavingsStore();

defineProps({
  savings: Array,
});
</script>
<template>
  <NewSavingsModal />
  <SavingsList :savings="savings" />
  <div class="mx-auto mt-4 w-fit">
    <PrimaryButton @click="savingsStore.setNewSavingsFormOpen(true)">
      + Savings
    </PrimaryButton>
  </div>
</template>
