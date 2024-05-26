<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import useBillsStore from '@/store/bills';

const billsStore = useBillsStore();
</script>

<template>
  <form class="m-8 mx-auto w-fit" @submit="billsStore.createBill">
    <h3 class="text-lg font-semibold">Create new Bill</h3>
    <div class="mt-4">
      <InputLabel class="mb-2" value="Name" />
      <TextInput
        type="text"
        :value="billsStore.name"
        @input="billsStore.setName($event.target.value)"
      />
    </div>
    <div class="mt-4">
      <InputLabel class="mb-2" value="Amount" />
      <TextInput
        type="number"
        step="0.01"
        :value="billsStore.amount"
        @input="billsStore.setAmount($event.target.value)"
      />
    </div>
    <PrimaryButton class="mt-4">Save</PrimaryButton>
  </form>
</template>
