<script setup lang="ts">
const transactionStore = useTransactionStore();
</script>

<template>
  <ExpensesExpenseCard
    v-for="deposit in transactionStore.deposits"
    :key="deposit.id.toString()"
    :title="deposit.dates.created.pretty"
    :amount="deposit.amount.pretty"
  />
</template>
