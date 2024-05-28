<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import InputError from '@/Components/Breeze/InputError.vue';

const expenseTypes = ref([
  {
    value: 'bill',
    label: 'Bill',
  },
  {
    value: 'budget',
    label: 'Budget',
  },
  {
    value: 'saving',
    label: 'Saving',
  },
]);

const form = useForm({
  type: expenseTypes.value[0].value,
  issuer: '',
  name: '',
  amount_in_cents: 0,
  due_day_of_month: 1,
  notes: '',
});

const submitForm = () => {
  form.amount_in_cents = form.amount_in_cents * 100;

  form.post(route('expenses.store'));
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <form
        @submit.prevent="submitForm"
        class="max-w-3xl space-y-6 bg-white p-6 rounded-lg"
      >
        <h3 class="text-lg font-semibold text-black">
          Add one of your monthly expenses.
        </h3>

        <div>
          <label for="type" class="block text-sm font-medium text-gray-700">
            Expense Type
          </label>
          <select
            v-model="form.type"
            id="type"
            name="type"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          >
            <option
              v-for="type in expenseTypes"
              :key="type.label"
              :value="type.value"
            >
              {{ type.label }}
            </option>
          </select>
          <InputError :message="form.errors.type" />
        </div>

        <div>
          <label for="issuer" class="block text-sm font-medium text-gray-700">
            Issuer
          </label>
          <input
            v-model="form.issuer"
            id="issuer"
            name="issuer"
            type="text"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="form.errors.issuer" />
        </div>

        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">
            Name
          </label>
          <input
            v-model="form.name"
            id="name"
            name="name"
            type="text"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
        </div>

        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700">
            Amount
          </label>
          <input
            v-model="form.amount"
            id="amount"
            name="amount"
            type="text"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
        </div>

        <div>
          <label
            for="due_day_of_month"
            class="block text-sm font-medium text-gray-700"
          >
            Due Day of Month
          </label>
          <input
            v-model="form.due_day_of_month"
            id="due_day_of_month"
            name="due_day_of_month"
            type="number"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
        </div>

        <div>
          <label for="notes" class="block text-sm font-medium text-gray-700">
            Notes
          </label>
          <textarea
            v-model="form.notes"
            id="notes"
            name="notes"
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
            rows="4"
          />
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
    </div>
  </MainLayout>
</template>
