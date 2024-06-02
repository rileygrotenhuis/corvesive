<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import Modal from '@/Components/Breeze/Modal.vue';
import InputError from '@/Components/Breeze/InputError.vue';

const props = defineProps({
  monthlyPaystub: Object,
});

const showModal = ref(false);

const paystubDepositForm = useForm({
  deposit_date: new Date().toISOString().substr(0, 10),
  amount: props.monthlyPaystub.amount_remaining / 100,
  amount_in_cents: props.monthlyPaystub.amount_remaining,
  notes: '',
});

const submitPaystubDeposit = () => {
  paystubDepositForm.amount_in_cents = paystubDepositForm.amount * 100;

  paystubDepositForm.post(
    route('monthly-paystubs.deposit', props.monthlyPaystub.id),
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
    <form class="p-6 space-y-6" @submit.prevent="submitPaystubDeposit">
      <div>
        <h3 class="text-lg font-medium leading-6 text-gray-900 mb-1">
          Make a Deposit
        </h3>

        <p class="text-gray-700 text-xs md:text-sm max-w-[500px]">
          Make a new deposit for this paystub.
        </p>
      </div>

      <div>
        <label
          for="deposit_date"
          class="block text-sm font-medium text-gray-700"
        >
          Deposit Date
        </label>
        <input
          v-model="paystubDepositForm.deposit_date"
          id="deposit_date"
          name="deposit_date"
          type="date"
          class="mt-1 text-black block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        />
      </div>

      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">
          Amount
        </label>
        <input
          v-model="paystubDepositForm.amount"
          id="amount"
          name="amount"
          type="text"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        />
        <InputError :message="paystubDepositForm.errors.amount_in_cents" />
      </div>

      <div>
        <label for="notes" class="block text-sm font-medium text-gray-700">
          Notes
        </label>
        <textarea
          v-model="paystubDepositForm.notes"
          id="notes"
          name="notes"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          rows="4"
        />
        <InputError :message="paystubDepositForm.errors.notes" />
      </div>

      <div class="flex justify-end">
        <button
          type="submit"
          class="inline-flex items-center px-4 py-2 bg-primary-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-800 focus:bg-primary-800 active:bg-primary-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
          Submit Deposit
        </button>
      </div>
    </form>
  </Modal>
</template>

<style scoped></style>
