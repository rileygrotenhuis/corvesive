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
    form.put(route('budgets.payment', props.budget.id));
    form.reset();
}
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold">{{ budget.name }}</h1>
            <a :href="route('budgets.edit', budget.id)">
                <PrimaryButton>Edit</PrimaryButton>
            </a>
        </div>
        <div class="mt-8 text-center">
            <h3 class="text-2xl">${{ (budget.amount / 100).toFixed(2) }}</h3>
            <form @submit.prevent="submit" class="mt-4 flex gap-2 justify-center">
                <TextInput autofocus type="number" step="0.01" v-model="form.amount" />
                <PrimaryButton>Make Payment</PrimaryButton>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
