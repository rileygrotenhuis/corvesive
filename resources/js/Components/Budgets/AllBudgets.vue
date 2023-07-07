<script setup>
defineProps({
    budgets: Object
});
</script>
<template>
    <ul class="w-fit mx-auto flex flex-col gap-4">
        <li v-for="budget in budgets" :key="budget.id">
            <div class="w-40 h-auto p-4 flex flex-col border border-black text-center rounded-md shadow-lg hover:cursor-pointer">
                <span class="font-bold text-2xl">{{ budget.name }}</span>
                <span class="font-extralight text-lg">${{ (budget.amount / 100).toFixed(2) }}</span>
                <span v-if="budget.show_daily_amount" class="font-extralight text-sm">(~${{ (budget.average_daily_amount / 100).toFixed(2) }}/day)</span>
            </div>
        </li>
    </ul>
</template>
