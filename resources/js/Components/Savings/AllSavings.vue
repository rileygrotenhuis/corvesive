<script setup>
import SavingItem from './SavingItem.vue';

defineProps({
  savings: Object,
});
</script>
<template>
  <ul class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="saving in savings" :key="saving.id">
      <SavingItem :saving="saving" />
    </li>
  </ul>
</template>
