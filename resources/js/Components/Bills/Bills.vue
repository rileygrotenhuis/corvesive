<script setup>
import NewBillsModal from '@/Components/Bills/NewBillsModal.vue';
import BillsList from '@/Components/Bills/BillsList.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useBillsStore from '@/store/bills';

const billsStore = useBillsStore();

defineProps({
  bills: Array,
});
</script>
<template>
  <NewBillsModal />
  <BillsList :bills="bills" />
  <div class="mx-auto mt-4 w-fit">
    <PrimaryButton @click="billsStore.setNewBillsFormOpen(true)">
      + Bill
    </PrimaryButton>
  </div>
</template>
