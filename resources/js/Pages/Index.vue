<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ExpenseTypeSwitch from '@/Components/UI/ExpenseTypeSwitch.vue';
import AllBudgets from '@/Components/Budgets/AllBudgets.vue';
import AllBills from '@/Components/Bills/AllBills.vue';
import AllSavings from '@/Components/Savings/AllSavings.vue';
import useStore from '@/Store/store';

const store = useStore();

defineProps({
  expenses: Object,
});
</script>

<template>
  <AuthenticatedLayout>
    <ExpenseTypeSwitch />
    <div class="mt-8">
        <AllBudgets v-if="store.expenseType === 'budgets'" :budgets="expenses.budgets.data" />
        <AllBills v-if="store.expenseType === 'bills'"  :bills="expenses.bills.data" />
        <AllSavings v-if="store.expenseType === 'savings'" :savings="expenses.savings.data" />
    </div>
  </AuthenticatedLayout>
</template>
