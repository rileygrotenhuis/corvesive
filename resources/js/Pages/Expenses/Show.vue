<script setup>
import TextInput from '@/Components/TextInput.vue';
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
    form.put(route('expenses.payment', props.expense.id));
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
            <form @submit.prevent="submit" class="mt-4 flex gap-2 justify-center">
                <TextInput autofocus type="number" step="0.01" v-model="form.amount" />
                <PrimaryButton>Make Payment</PrimaryButton>
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
