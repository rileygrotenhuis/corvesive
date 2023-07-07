<script setup>
defineProps({
    savings: Object
});
</script>
<template>
<ul class="w-fit mx-auto flex flex-col gap-4">
    <li v-for="saving in savings" :key="saving.id">
        <div class="w-40 h-auto p-4 flex flex-col border border-black text-center rounded-md shadow-lg hover:cursor-pointer">
            <span class="font-bold text-2xl">{{ saving.name }}</span>
            <span class="font-extralight text-lg">${{ (saving.amount / 100).toFixed(2) }}</span>
        </div>
    </li>
</ul>
</template>
