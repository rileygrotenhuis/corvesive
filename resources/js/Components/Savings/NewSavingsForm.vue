<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import useSavingsStore from '@/store/savings';

const savingsStore = useSavingsStore();
</script>

<template>
  <form class="m-8 mx-auto w-fit" @submit="savingsStore.createSavings">
    <h3 class="text-lg font-semibold">Create new Savings</h3>
    <div class="mt-4">
      <InputLabel class="mb-2" value="Name" />
      <TextInput
        type="text"
        :value="savingsStore.name"
        @input="savingsStore.setName($event.target.value)"
      />
    </div>
    <div class="mt-4">
      <InputLabel class="mb-2" value="Amount" />
      <TextInput
        type="number"
        step="0.01"
        :value="savingsStore.amount"
        @input="savingsStore.setAmount($event.target.value)"
      />
    </div>
    <PrimaryButton class="mt-4">Save</PrimaryButton>
  </form>
</template>
