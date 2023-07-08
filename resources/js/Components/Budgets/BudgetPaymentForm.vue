<script setup>
import TextInput from '@/Components/TextInput.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import useBudgetsStore from '@/store/budgets';

const budgetsStore = useBudgetsStore();
</script>

<template>
  <form
    class="m-8 mx-auto w-fit"
    @submit.prevent="
      budgetsStore.makeBudgetPayment(budgetsStore.currentBudget.id)
    "
  >
    <div class="mb-4 mt-4">
      <InputLabel class="mb-2" value="Amount" />
      <TextInput
        autofocus
        type="number"
        step="0.01"
        :value="budgetsStore.paymentAmount"
        @input="budgetsStore.setPaymentAmount($event.target.value)"
      />
    </div>
    <PrimaryButton>Make Payment</PrimaryButton>
  </form>
</template>
