<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import ScheduleExpense from '@/Pages/Expenses/Partials/ScheduleExpense.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import { watch } from 'vue';
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';

const props = defineProps({
  expense: Object,
});

const form = useForm({
  type: props.expense.type,
  issuer: props.expense.issuer,
  name: props.expense.name,
  amount: props.expense.amount_in_cents / 100,
  amount_in_cents: props.expense.amount_in_cents,
  due_day_of_month: props.expense.due_day_of_month,
  notes: props.expense.notes,
});

watch(
  () => form.type,
  (value) => {
    if (value !== 'bill') {
      form.issuer = '';
      form.due_day_of_month = 28;
    }
  }
);

const submitForm = () => {
  if (confirm('Are you sure you want to save this expense?')) {
    form.amount_in_cents = form.amount * 100;

    form.put(route('expenses.update', props.expense.id));
  }
};

const removeExpense = () => {
  if (confirm('Are you sure you want to remove this expense?')) {
    form.delete(route('expenses.destroy', props.expense.id));
  }
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <form
        @submit.prevent="submitForm"
        class="max-w-3xl space-y-6 bg-white p-6 rounded-lg"
      >
        <a
          :href="route('expenses.index')"
          class="text-primary-700 hover:font-bold"
        >
          &larr; Back to Expenses
        </a>

        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-black">
            Modify your monthly expense.
          </h3>

          <div class="flex items-center gap-4">
            <ScheduleExpense :expense="expense" />
            <UnscheduleIcon @click.prevent="removeExpense" />
          </div>
        </div>

        <div v-if="form.type === 'bill'">
          <label for="issuer" class="block text-sm font-medium text-gray-700">
            Issuer
          </label>
          <input
            v-model="form.issuer"
            id="issuer"
            name="issuer"
            type="text"
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

        <div v-if="form.type === 'bill'">
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
