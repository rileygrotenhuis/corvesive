<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
    budget: Object
});
</script>

<template>
    <AuthenticatedLayout>
        <h1 class="text-xl font-semibold">{{ budget.name }}</h1>
    </AuthenticatedLayout>
</template>
