<script setup>
defineProps({
    bills: Object
});
</script>
<template>
<ul>
    <li v-for="bill in bills" :key="bill.id">
        {{ bill.name }}
    </li>
</ul>
</template>
