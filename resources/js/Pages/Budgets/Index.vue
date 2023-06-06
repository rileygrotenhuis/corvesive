<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    defineProps({
        budgets: Array
    });
</script>

<template>
    <AuthenticatedLayout>
        <h1>All Budgets</h1>
        <ul>
            <li v-for="budget in budgets" :key="budget.id">{{ budget.name }}</li>
        </ul>
    </AuthenticatedLayout>
</template>
