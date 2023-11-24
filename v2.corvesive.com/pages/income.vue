<script setup lang="ts">
useHead({
  title: 'Corvesive - Expenses',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const accountStore = useAccountStore();
const paystubStore = usePaystubStore();
const transactionStore = useTransactionStore();

await paystubStore.getPayPeriodPaystubs(accountStore.user.pay_period.id);
await transactionStore.getPayPeriodDeposits(accountStore.user.pay_period.id);
await paystubStore.getPaystubs();

const tabs = [
  {
    key: 'paystubs',
    label: 'Paystubs',
  },
  {
    key: 'deposits',
    label: 'Deposits',
  },
];
</script>

<template>
  <div>
    <UTabs :items="tabs" class="w-full">
      <template #item="{ item }">
        <UCard>
          <div class="flex flex-col gap-4">
            <ExpensesPaystubsTable v-if="item.key === 'paystubs'" />
            <ExpensesDepositsTable v-if="item.key === 'deposits'" />
          </div>
        </UCard>
      </template>
    </UTabs>
  </div>
</template>
