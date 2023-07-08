<script setup>
import BillItem from './BillItem.vue';

defineProps({
  bills: Array,
});
</script>

<template>
  <ul v-if="bills.length > 0" class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="bill in bills" :key="bill.id">
      <BillItem :bill="bill" />
    </li>
  </ul>
  <div v-else>
    <p class="mx-auto w-96 text-center">
      Create a new Bill entry to track your consistent monthly expenses like
      rent and utilities
    </p>
  </div>
</template>
