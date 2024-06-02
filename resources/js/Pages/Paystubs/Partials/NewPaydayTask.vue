<script setup>
import { computed, ref } from 'vue';
import Modal from '@/Components/Breeze/Modal.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  monthlyPaystub: Object,
  paydayTasks: Array,
  upcomingExpenses: Object,
  monthSelectionOptions: Array,
});

const showModal = ref(false);

const selectedMonth = ref(props.monthSelectionOptions[0]?.value ?? null);

const filteredExpenses = computed(() => {
  return props.upcomingExpenses[selectedMonth.value] ?? [];
});

const form = useForm({
  monthly_expense_id: '',
  amount: '',
  amount_in_cents: 0,
});

const submit = () => {
  form.amount_in_cents = form.amount * 100;

  form.post(route('payday-tasks.store', props.monthlyPaystub.id), {
    preserveScroll: true,
    onSuccess: () => {
      showModal.value = false;
      form.reset();
    },
  });
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
    <form class="p-6 space-y-6" @submit.prevent="submit">
      <div>
        <h3 class="text-lg font-medium leading-6 text-gray-900">
          New Pay Day Task
        </h3>

        <p class="text-gray-700 text-xs md:text-sm max-w-[500px]">
          Attach a monthly expense to this paystub to be paid on this pay day.
        </p>
      </div>

      <div>
        <label
          for="selected_month"
          class="block text-sm font-medium text-gray-700"
        >
          Selected Month
        </label>
        <select
          v-model="selectedMonth"
          id="selected_month"
          name="selected_month"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        >
          <option
            v-for="option in props.monthSelectionOptions"
            :key="option.value"
            :value="option.value"
          >
            {{ option.label }}
          </option>
        </select>
      </div>

      <div>
        <label
          for="monthly_expense_id"
          class="block text-sm font-medium text-gray-700"
        >
          Selected Expense
        </label>
        <select
          v-model="form.monthly_expense_id"
          id="monthly_expense_id"
          name="monthly_expense_id"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        >
          <option
            v-for="(expense, index) in filteredExpenses"
            :key="index"
            :value="expense.id"
          >
            {{ expense.issuer ?? `Monthly ${expense.type}` }} -
            {{ expense.name }}
          </option>
        </select>
        <InputError :message="form.errors.monthly_expense_id" />
      </div>

      <div>
        <label
          for="amount_in_cents"
          class="block text-sm font-medium text-gray-700"
        >
          Amount
        </label>
        <input
          v-model="form.amount"
          id="amount"
          name="amount"
          type="text"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        />
        <InputError :message="form.errors.amount_in_cents" />
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
  </Modal>
</template>
