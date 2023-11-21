<script setup lang="ts">
useHead({
  title: 'Corvesive - Expenses',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const accountStore = useAccountStore();
const savingStore = useSavingStore();

await savingStore.getSavings();
await savingStore.getPayPeriodSavings(accountStore.user.pay_period.id);
</script>

<template>
  <div class="mt-8">
    <UCard>
      <div class="flex flex-col gap-4">
        <ExpensesSavingsTable />
      </div>
    </UCard>
  </div>
</template>
