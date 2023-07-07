<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ExpenseTypeSwitch from '@/Components/UI/ExpenseTypeSwitch.vue';
import AllBudgets from '@/Components/Budgets/AllBudgets.vue';
import AllBills from '@/Components/Bills/AllBills.vue';
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
      <AllBudgets
        v-if="store.expenseType === 'budgets'"
        :budgets="expenses.budgets.data"
      />
      <AllBills
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
