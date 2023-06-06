<script setup>
    import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

    defineProps({
        budgets: Array
    });
</script>

<template>
    <AuthenticatedLayout>
        <h1 class="text-xl text-center font-semibold">Your Budgets</h1>
        <div class="mt-4 flex flex-col gap-4">
            <div class="w-48 mx-auto" v-for="budget in budgets" :key="budget.id">
                <a :href="route('budgets.show', budget.id)">
                    <div class="text-center border bg-slate-50 shadow-md w-48 p-4 rounded-md">
                        <h3 class="text-2xl font-semibold">{{ budget.name }}</h3>
                        <h4 class="text-xl">${{ (budget.amount / 100).toFixed(2) }}</h4>
                        <h4>(~${{ (budget.average_daily_amount / 100).toFixed(2) }}/day)</h4>
                    </div>
                </a>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
