<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ExpenseTypeSwitch from '@/Components/UI/ExpenseTypeSwitch.vue';
import Budgets from '@/Components/Budgets/Budgets.vue';
import Bills from '@/Components/Bills/Bills.vue';
import Savings from '@/Components/Savings/Savings.vue';
import useStore from '@/store/store';

const store = useStore();

defineProps({
  expenses: Object,
});
</script>

<template>
  <AuthenticatedLayout>
    <ExpenseTypeSwitch />
    <div class="mt-8">
      <Budgets
        v-if="store.expenseType === 'budgets'"
        :budgets="expenses.budgets.data"
      />
      <Bills
        v-if="store.expenseType === 'bills'"
        :bills="expenses.bills.data"
      />
      <Savings
        v-if="store.expenseType === 'savings'"
        :savings="expenses.savings.data"
      />
    </div>
  </AuthenticatedLayout>
</template>
