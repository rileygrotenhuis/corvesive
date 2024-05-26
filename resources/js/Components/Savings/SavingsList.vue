<script setup>
import SavingItem from '@/Components/Savings/SavingItem.vue';

defineProps({
  savings: Array,
});
</script>

<template>
  <ul v-if="savings.length > 0" class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="saving in savings" :key="saving.id">
      <SavingItem :saving="saving" />
    </li>
  </ul>
  <div v-else>
    <p class="mx-auto w-96 text-center">
      Create a new Savings entry to track the different places your paycheck is
      going towards for savings
    </p>
  </div>
</template>
