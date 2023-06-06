<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    budget: Object
});
</script>

<template>
    <AuthenticatedLayout>
        <div class="flex justify-between">
            <h1 class="text-xl font-semibold">{{ budget.name }}</h1>
            <a :href="route('budgets.edit', budget.id)">
                <PrimaryButton>Edit</PrimaryButton>
            </a>
        </div>
    </AuthenticatedLayout>
</template>
