<script setup>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    defineProps({
        budgets: Array
    });
</script>

<template>
    <AuthenticatedLayout>
        <h1 class="text-xl font-semibold">Your Budgets</h1>
        <table class="w-full mt-4">
            <thead>
                <tr class="px-4 py-2">
                    <th class="border bg-slate-300 px-4 py-2">ID</th>
                    <th class="border bg-slate-300 px-4 py-2">Name</th>
                    <th class="border bg-slate-300 px-4 py-2">Amount</th>
                    <th class="border bg-slate-300 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="budget in budgets" :key="budget.id">
                    <td class="border px-4 py-2 text-center">{{ budget.id }}</td>
                    <td class="border px-4 py-2 text-center">{{ budget.name }}</td>
                    <td class="border px-4 py-2 text-center">${{ (budget.amount / 100).toFixed(2) }}</td>
                    <td class="border px-4 py-2 flex gap-2 justify-center">
                        <a :href="route('budgets.show', budget.id)">
                            <PrimaryButton>Show</PrimaryButton>
                        </a>
                        <a :href="route('budgets.edit', budget.id)">
                            <PrimaryButton>Edit</PrimaryButton>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </AuthenticatedLayout>
</template>
