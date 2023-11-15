<script setup lang="ts">
useHead({
  title: 'Corvesive - Expenses',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const savingStore = useSavingStore();

await savingStore.getSavings();
</script>

<template>
  <div class="mt-8">
    <UCard>
      <div class="flex flex-col gap-4">
        <ExpensesExpenseCard
          v-for="saving in savingStore.savings"
          :key="saving.id.toString()"
          :title="saving.name"
          :amount="saving.amount.pretty"
        />
      </div>
    </UCard>
  </div>
</template>
