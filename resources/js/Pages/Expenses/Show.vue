<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
    expense: Object
});

const form = useForm({
    amount: null,
});

const submit = () => {
    form.post(props.expense.is_payed
        ? route('expenses.unpayment', props.expense.id)
        : route('expenses.payment', props.expense.id));
    form.reset();
};

const deleteexpense = () => {
    useForm({}).delete(route('expenses.destroy', props.expense.id));
};
</script>

<template>
    <AuthenticatedLayout>
        <h1 class="text-4xl text-center font-semibold">{{ expense.name }}</h1>
        <div class="mt-8 text-center">
            <h3 class="text-2xl font-semibold">${{ (expense.amount / 100).toFixed(2) }}</h3>
            <h3 class="text-xl mt-2">(payment status will go here)</h3>
            <form @submit.prevent="submit" class="mt-4 flex gap-2 justify-center">
                <PrimaryButton v-if="expense.is_payed">Unpay Bill</PrimaryButton>
                <PrimaryButton v-else>Pay Bill</PrimaryButton>
            </form>
            <div class="mt-4 flex gap-4 justify-center">
                <a :href="route('expenses.edit', expense.id)">
                    <PrimaryButton>Edit</PrimaryButton>
                </a>
                <PrimaryButton @click.prevent="deleteexpense" class="bg-red-500">Delete</PrimaryButton>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
