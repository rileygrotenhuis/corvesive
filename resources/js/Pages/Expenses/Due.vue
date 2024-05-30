<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import RescheduleExpense from '@/Pages/Expenses/Partials/RescheduleExpense.vue';
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/Breeze/InputError.vue';
import { ref } from 'vue';
import ModifyIcon from '@/Components/Icons/ModifyIcon.vue';

const props = defineProps({
  monthlyExpense: Object,
});

const showModifyForm = ref(false);

const unscheduleExpense = () => {
  if (confirm('Are you sure you want to unschedule this expense?')) {
    useForm({}).delete(
      route('monthly-expenses.unschedule', props.monthlyExpense.id)
    );
  }
};

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
    }
  );
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 my-8">
      <div class="max-w-3xl bg-white p-6 rounded-lg">
        <div class="my-2">
          <a
            :href="route('expenses.index')"
            class="text-primary-700 hover:font-bold"
          >
            &larr; Back to Expenses
          </a>
        </div>

        <div class="flex justify-between">
          <a :href="route('expenses.index', monthlyExpense.expense.id)">
            <h2 class="text-2xl font-bold text-primary-700">
              {{ monthlyExpense.expense.name }}
            </h2>
            <p class="text-md font-semibold text-primary-950">
              <span v-if="monthlyExpense?.expense?.issuer">
                {{ monthlyExpense.expense.issuer }} -
              </span>
              {{ monthlyExpense.expense.type }}
            </p>
          </a>

          <div class="flex items-center gap-4">
            <RescheduleExpense :monthlyExpense="monthlyExpense" />
            <UnscheduleIcon @click.prevent="unscheduleExpense" />
          </div>
        </div>

        <div class="text-black text-sm mt-2">
          {{ monthlyExpense.expense.notes }}
        </div>

        <div class="text-black text-sm font-semibold mt-2">
          Due: {{ monthlyExpense.due_day }}
        </div>

        <div class="mt-4 font-medium text-gray-700">
          <div class="flex items-center gap-2">
            <span class="text-gray-500">
              ${{ (monthlyExpense.amount_paid / 100).toFixed(2) }} of
            </span>
            <span class="text-primary-700 font-bold text-lg">
              ${{ (monthlyExpense.amount_in_cents / 100).toFixed(2) }} paid
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
            <InputError :message="modifyExpenseForm.errors.amount" />
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

        <div class="mt-12 text-black">
          {{ JSON.stringify(monthlyExpense?.payments ?? []) }}
        </div>
      </div>
    </div>
  </MainLayout>
</template>
