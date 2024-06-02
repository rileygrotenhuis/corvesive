<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { computed, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/Breeze/InputError.vue';

const props = defineProps({
  monthlyExpense: Object,
});

const isBill = computed(() => {
  return props.monthlyExpense.expense.type === 'Bill';
});

const showModal = ref(false);

const expensePaymentForm = useForm({
  payment_date: new Date().toISOString().substr(0, 10),
  amount: isBill.value ? props.monthlyExpense.amount_remaining / 100 : 0,
  amount_in_cents: isBill.value
    ? props.monthlyExpense.amount_remaining / 100
    : 0,
  notes: '',
});

const submitExpensePayment = () => {
  expensePaymentForm.amount_in_cents = expensePaymentForm.amount * 100;

  expensePaymentForm.post(
    route('monthly-expenses.payment', props.monthlyExpense.id),
    {
      preserveScroll: true,
      onSuccess: () => {
        showModal.value = false;
      },
    }
  );
};
</script>

<template>
  <button
    @click.prevent="showModal = true"
    class="w-8 h-8 flex text-center justify-center items-center bg-primary-100 p-2 text-primary-1000 font-bold rounded-full hover:bg-primary-700 hover:text-primary-100 transition ease-in-out"
  >
    +
  </button>

  <Modal :show="showModal" @close="showModal = false">
    <form class="p-6 space-y-6" @submit.prevent="submitExpensePayment">
      <div>
        <h3 class="text-lg font-medium leading-6 text-gray-900">
          Make a Payment
        </h3>

        <p class="text-gray-700 text-xs md:text-sm max-w-[500px]">
          Make a new payment for this expense.
        </p>
      </div>

      <div>
        <label
          for="payment_date"
          class="block text-sm font-medium text-gray-700"
        >
          Payment Date
        </label>
        <input
          v-model="expensePaymentForm.payment_date"
          id="payment_date"
          name="payment_date"
          type="date"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        />
        <InputError :message="expensePaymentForm.errors.payment_date" />
      </div>

      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">
          Amount
        </label>
        <input
          v-model="expensePaymentForm.amount"
          id="amount"
          name="amount"
          type="text"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        />
        <InputError :message="expensePaymentForm.errors.amount_in_cents" />
      </div>

      <div>
        <label for="notes" class="block text-sm font-medium text-gray-700">
          Notes
        </label>
        <textarea
          v-model="expensePaymentForm.notes"
          id="notes"
          name="notes"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          rows="4"
        />
        <InputError :message="expensePaymentForm.errors.notes" />
      </div>

      <div class="flex justify-end">
        <button
          type="submit"
          class="inline-flex items-center px-4 py-2 bg-primary-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-800 focus:bg-primary-800 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
          Submit Payment
        </button>
      </div>
    </form>
  </Modal>
</template>
