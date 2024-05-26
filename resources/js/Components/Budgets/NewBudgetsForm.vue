<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import useBudgetsStore from '@/store/budgets';

const budgetsStore = useBudgetsStore();
</script>

<template>
  <form class="m-8 mx-auto w-fit" @submit="budgetsStore.createBudget">
    <h3 class="text-lg font-semibold">Create new Budget</h3>
    <div class="mt-4">
      <InputLabel class="mb-2" value="Name" />
      <TextInput
        type="text"
        :value="budgetsStore.name"
        @input="budgetsStore.setName($event.target.value)"
      />
    </div>
    <div class="mt-4">
      <InputLabel class="mb-2" value="Amount" />
      <TextInput
        type="number"
        step="0.01"
        :value="budgetsStore.amount"
        @input="budgetsStore.setAmount($event.target.value)"
      />
    </div>
    <div class="mt-4 flex gap-2">
      <Checkbox
        :value="budgetsStore.showDailyAmount"
        @input="budgetsStore.setShowDailyAmount(!budgetsStore.showDailyAmount)"
      />
      <InputLabel class="mb-2" value="Show Daily Amount" />
    </div>
    <PrimaryButton class="mt-4">Save</PrimaryButton>
  </form>
</template>
