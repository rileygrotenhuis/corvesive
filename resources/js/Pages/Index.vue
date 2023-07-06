<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ExpenseTypeSwitch from '@/Components/UI/ExpenseTypeSwitch.vue';
</script>

<template>
  <AuthenticatedLayout>
    <ExpenseTypeSwitch />
  </AuthenticatedLayout>
</template>
