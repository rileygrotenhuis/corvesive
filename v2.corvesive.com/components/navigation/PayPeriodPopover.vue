<script setup lang="ts">
const payPeriodStore = usePayPeriodStore();
const accountStore = useAccountStore();

const payPeriodSelectOptions = payPeriodStore.payPeriods.map((payPeriod) => {
  return {
    label: `${payPeriod.dates.start.pretty.short} - ${payPeriod.dates.end.pretty.short}`,
    value: payPeriod.id,
  };
});

const selectedPayPeriod = ref(payPeriodStore.currentPayPeriod.id);

watch(
  selectedPayPeriod,
  async (newPayPeriodId: Number, oldPayPeriodId: Number) => {
    await payPeriodStore.updateCurrentPayPeriod(newPayPeriodId);
  }
);
</script>

<template>
  <UPopover :popper="{ placement: 'bottom-end' }">
    <UIcon name="i-heroicons-calendar" class="w-5 h-5" />

    <template #panel>
      <div class="p-4 w-[250px] flex flex-col gap-4">
        <UFormGroup label="Current Period">
          <USelect
            v-model="selectedPayPeriod"
            :options="payPeriodSelectOptions"
          />
        </UFormGroup>
        <div class="flex gap-1">
          <UButton
            icon="i-heroicons-pencil-square"
            to="/period/settings"
            label="Settings"
            color="rose"
            variant="outline"
            class="w-1/2"
            size="sm"
          />
          <UButton
            icon="i-heroicons-plus"
            to="/period/new"
            label="Create"
            color="rose"
            class="w-1/2"
            size="sm"
          />
        </div>
        <UButton
          :icon="`${
            accountStore.isRecurringView
              ? 'i-heroicons-clock'
              : 'i-heroicons-calendar'
          }`"
          :label="`${
            accountStore.isRecurringView
              ? 'View Current Period'
              : 'View Recurring'
          }`"
          color="rose"
          class="w-full"
          variant="outline"
          size="sm"
          block
          @click="accountStore.toggleMonthlyView()"
        />
      </div>
    </template>
  </UPopover>
</template>
