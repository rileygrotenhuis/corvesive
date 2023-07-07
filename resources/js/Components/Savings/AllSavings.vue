<script setup>
defineProps({
    savings: Object
});
</script>
<template>
<ul>
    <li v-for="saving in savings" :key="saving.id">
        {{ saving.name }}
    </li>
</ul>
</template>
