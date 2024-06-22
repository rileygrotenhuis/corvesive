<script setup>
import ModifyIcon from '@/Components/Icons/ModifyIcon.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { computed, ref } from 'vue';

const props = defineProps({
  monthlyExpense: Object,
});

const showModifyForm = ref(false);

const amountPaid = computed(() => {
  return (props.monthlyExpense.amount_paid / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const amount = computed(() => {
  return (props.monthlyExpense.amount_in_cents / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const modifyExpenseForm = useForm({
  amount: props.monthlyExpense.amount_in_cents / 100,
  amount_in_cents: props.monthlyExpense.amount_in_cents,
});

const modifyExpense = () => {
  modifyExpenseForm.amount_in_cents = modifyExpenseForm.amount * 100;

  modifyExpenseForm.put(
    route('monthly-expenses.update', props.monthlyExpense.id),
    {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        showModifyForm.value = false;
      },
    }
  );
};
</script>

<template>
  <div class="mt-4 font-medium text-gray-700">
    <div class="flex items-center gap-2">
      <span class="text-gray-500"> {{ amountPaid }} of </span>
      <span class="text-primary-700 font-bold text-lg">
        {{ amount }} paid
      </span>
      <span
        class="cursor-pointer"
        @click.prevent="showModifyForm = !showModifyForm"
      >
        <ModifyIcon />
      </span>
    </div>
  </div>

  <form
    v-if="showModifyForm"
    @submit.prevent="modifyExpense"
    class="space-y-6 mt-2"
  >
    <div>
      <label for="amount" class="block text-sm font-medium text-gray-700">
        Modify this monthly expense.
      </label>
      <input
        v-model="modifyExpenseForm.amount"
        id="amount"
        name="amount"
        type="text"
        required
        class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
      />
      <InputError :message="modifyExpenseForm.errors.amount_in_cents" />
    </div>

    <div class="flex justify-end">
      <button
        type="submit"
        class="w-full md:w-fit flex justify-center py-1 px-8 bg-primary-700 text-white font-semibold rounded-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
      >
        Save
      </button>
    </div>
  </form>
</template>

<style scoped></style>
