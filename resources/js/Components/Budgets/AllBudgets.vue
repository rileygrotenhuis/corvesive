<script setup>
defineProps({
    budgets: Object
});
</script>
<template>
<ul>
    <li v-for="budget in budgets" :key="budget.id">
        {{ budget.name }}
    </li>
</ul>
</template>
