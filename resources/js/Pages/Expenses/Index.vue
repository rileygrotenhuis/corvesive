<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

defineProps({
    expenses: Array
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="mt-4 flex flex-col gap-4">
            <div class="w-48 mx-auto" v-for="expense in expenses" :key="expense.id">
                <a :href="route('expenses.show', expense.id)">
                    <div class="text-center border bg-slate-50 shadow-md w-48 p-4 rounded-md">
                        <h3 class="text-2xl font-semibold">{{ expense.name }}</h3>
                        <h4 class="text-xl">${{ (expense.amount / 100).toFixed(2) }}</h4>
                    </div>
                </a>
            </div>
            <a class="w-auto mx-auto" :href="route('expenses.create')">
                <PrimaryButton>+ Expense</PrimaryButton>
            </a>
        </div>
    </AuthenticatedLayout>
</template>
