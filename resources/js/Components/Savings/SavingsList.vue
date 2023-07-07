<script setup>
import SavingItem from '@/Components/Savings/SavingItem.vue';

defineProps({
  savings: Array,
});
</script>

<template>
  <ul class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="saving in savings" :key="saving.id">
      <SavingItem :saving="saving" />
    </li>
  </ul>
</template>
