<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ExpenseTypeSwitch from '@/Components/UI/ExpenseTypeSwitch.vue';
import useStore from '@/Store/store';

const store = useStore();

defineProps({
  expenses: Object,
});
</script>

<template>
  <AuthenticatedLayout>
    <ExpenseTypeSwitch />
    <ul>
      <li v-for="expense in expenses[store.expenseType].data" :key="expense.id">
        {{ expense.name }}
      </li>
    </ul>
  </AuthenticatedLayout>
</template>
