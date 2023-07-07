<script setup>
defineProps({
    bills: Object
});
</script>
<template>
<ul class="w-fit mx-auto flex flex-col gap-4">
    <li v-for="bill in bills" :key="bill.id">
        <div class="w-40 h-auto p-4 flex flex-col border border-black text-center rounded-md shadow-lg hover:cursor-pointer">
            <span class="font-bold text-2xl">{{ bill.name }}</span>
            <span class="font-extralight text-lg">${{ (bill.amount / 100).toFixed(2) }}</span>
        </div>
    </li>
</ul>
</template>
