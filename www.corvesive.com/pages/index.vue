<script setup lang="ts">
useHead({
  title: 'Corvesive',
});

definePageMeta({
  middleware: 'auth',
  layout: 'main',
});

const accountStore = useAccountStore();
const recurringStore = useRecurringStore();
const payPeriodsStore = usePayPeriodStore();

await recurringStore.getRecurringMetrics(true);
await payPeriodsStore.getPayPeriodAttributes(
  accountStore.user.pay_period.id,
  true
);
await payPeriodsStore.getPayPeriodMetrics(
  accountStore.user.pay_period.id,
  true
);

const tabs = [
  {
    key: 'dashboard',
    label: 'Dashboard',
  },
  {
    key: 'metrics',
    label: 'Metrics',
  },
];
</script>

<template>
  <div>
    <UTabs :items="tabs" class="w-full">
      <template #item="{ item }">
        <UCard>
          <div class="flex flex-col gap-4">
            <MetricsPayPeriodAttributes v-if="item.key === 'dashboard'" />
            <MetricsPayPeriodMetrics
              v-if="item.key === 'metrics' && !accountStore.isRecurringView"
            />
            <MetricsRecurringMetrics
              v-if="item.key === 'metrics' && accountStore.isRecurringView"
            />
          </div>
        </UCard>
      </template>
    </UTabs>
  </div>
</template>
