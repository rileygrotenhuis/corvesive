<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import RescheduleExpense from '@/Pages/Expenses/Partials/RescheduleExpense.vue';
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';
import ModifyMonthlyExpense from '@/Pages/Expenses/Partials/ModifyMonthlyExpense.vue';
import { useForm } from '@inertiajs/vue3';
import PaymentBanner from '@/Components/Transactions/PaymentBanner.vue';
import ExpensePayment from '@/Pages/Expenses/Partials/ExpensePayment.vue';
import PaidIcon from '@/Components/Icons/PaidIcon.vue';

const props = defineProps({
  monthlyExpense: Object,
});

const unscheduleExpense = () => {
  if (confirm('Are you sure you want to unschedule this expense?')) {
    useForm({}).delete(
      route('monthly-expenses.unschedule', props.monthlyExpense.id)
    );
  }
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 my-8">
      <div class="w-full md:w-2/3 bg-white p-6 rounded-lg">
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
            <h2
              class="text-2xl font-bold text-primary-700 flex items-center gap-2"
            >
              {{ monthlyExpense.expense.name }}
              <span v-if="monthlyExpense.is_paid">
                <PaidIcon />
              </span>
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

        <ModifyMonthlyExpense :monthlyExpense="monthlyExpense" />

        <div class="mt-8 text-black">
          <div class="flex justify-between items-center">
            <h4 class="text-lg font-bold text-black">Payments</h4>

            <ExpensePayment :monthlyExpense="monthlyExpense" />
          </div>

          <div v-if="monthlyExpense.payments.length > 0" class="space-y-2 mt-4">
            <PaymentBanner
              v-for="payment in monthlyExpense.payments"
              :key="payment.id"
              :transaction="payment"
            />
          </div>
          <div v-else class="text-sm text-gray-500 mt-2">
            No payments have been made for this expense.
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
