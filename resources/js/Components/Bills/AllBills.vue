<script setup>
import BillItem from './BillItem.vue';

defineProps({
  bills: Object,
});
</script>
<template>
  <ul class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="bill in bills" :key="bill.id">
      <BillItem :bill="bill" />
    </li>
  </ul>
</template>
