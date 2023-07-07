<script setup>
defineProps({
  budgets: Object,
});
</script>
<template>
  <ul class="mx-auto flex w-fit flex-col gap-4">
    <li v-for="budget in budgets" :key="budget.id">
      <div
        class="flex h-auto w-40 flex-col rounded-md border border-black p-4 text-center shadow-lg hover:cursor-pointer"
      >
        <span class="text-2xl font-bold">{{ budget.name }}</span>
        <span class="text-lg font-extralight"
          >${{ (budget.amount / 100).toFixed(2) }}</span
        >
        <span v-if="budget.show_daily_amount" class="text-sm font-extralight"
          >(~${{ (budget.average_daily_amount / 100).toFixed(2) }}/day)</span
        >
      </div>
    </li>
  </ul>
</template>
