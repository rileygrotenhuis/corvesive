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
  <div class="mt-8">
    <UTabs :items="tabs" class="w-full">
      <template #item="{ item }">
        <UCard>
          <div class="flex flex-col gap-4">
              <ExpensesExpenseCard
                v-if="accountStore.isRecurringView && item.key === 'paystubs'"
                v-for="paystub in paystubStore.paystubs"
                :key="paystub.id.toString()"
                :title="paystub.issuer"
                :subtitle="paystub.type"
                :amount="paystub.amount.pretty"
              />
              <ExpensesExpenseCard
                v-else-if="!accountStore.isRecurringView && item.key === 'paystubs'"
                v-for="paystub in paystubStore.payPeriodPaystubs"
                :key="`${paystub.pay_period.id} - ${paystub.id}`"
                :title="paystub.paystub.issuer"
                :subtitle="paystub.paystub.type"
                :amount="paystub.amount.pretty"
              />
            <ExpensesExpenseCard
              v-else-if="item.key === 'deposits'"
              v-for="deposit in transactionStore.deposits"
              :key="deposit.id.toString()"
              :title="deposit.dates.created.pretty"
              :amount="deposit.amount.pretty"
            />
          </div>
        </UCard>
      </template>
    </UTabs>
  </div>
</template>
