<script setup>
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    budget: Object
});

const form = useForm({
    amount: null,
});

const submit = () => {
    form.post(route('budgets.payment', props.budget.id));
    form.reset();
};

const deleteBudget = () => {
    useForm({}).delete(route('budgets.destroy', props.budget.id));
};
</script>

<template>
    <AuthenticatedLayout>
        <h1 class="text-4xl text-center font-semibold">{{ budget.name }}</h1>
        <div class="mt-8 text-center">
            <h3 class="text-2xl font-semibold">${{ (budget.amount / 100).toFixed(2) }}</h3>
            <h3 class="text-xl mt-2" v-if="budget.show_daily_amount">(~${{ (budget.average_daily_amount / 100).toFixed(2) }}/day)</h3>
            <form @submit.prevent="submit" class="mt-4 flex gap-2 justify-center">
                <TextInput autofocus type="number" step="0.01" v-model="form.amount" />
                <PrimaryButton>Make Payment</PrimaryButton>
            </form>
            <div class="mt-4 flex gap-4 justify-center">
                <a :href="route('budgets.edit', budget.id)">
                    <PrimaryButton>Edit</PrimaryButton>
                </a>
                <PrimaryButton @click.prevent="deleteBudget" class="bg-red-500">Delete</PrimaryButton>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
