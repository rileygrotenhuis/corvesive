<script setup lang="ts">
const payPeriodStore = usePayPeriodStore();
const accountStore = useAccountStore();
const modalStore = useModalStore();

const payPeriodSelectOptions = payPeriodStore.payPeriods.map((payPeriod) => {
  return {
    label: `${payPeriod.dates.start.pretty.short} - ${payPeriod.dates.end.pretty.short}`,
    value: payPeriod.id,
  };
});

const selectedPayPeriod = ref(accountStore.user.pay_period.id);

watch(
  selectedPayPeriod,
  async (newPayPeriodId: number, oldPayPeriodId: number) => {
    useToast().add({
      title: 'You have switched your currently selected Pay Period!',
    });
    await useNuxtApp().$api.account.updateAccount({
      first_name: accountStore.user.names.first,
      last_name: accountStore.user.names.last,
      email: accountStore.user.email,
      phone_number: accountStore.user.phone_number,
      pay_period_id: newPayPeriodId,
    });
    window.location.reload();
  }
);
</script>

<template>
  <UPopover :popper="{ placement: 'bottom-end' }">
    <UIcon
      :name="`${
        !accountStore.isRecurringView
          ? 'i-heroicons-clock'
          : 'i-heroicons-calendar'
      }`"
      class="w-5 h-5 text-fuchsia-500"
    />

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
            label="Settings"
            color="fuchsia"
            variant="outline"
            class="w-1/2"
            size="sm"
            @click="modalStore.openPayPeriodModal('settings')"
          />
          <UButton
            icon="i-heroicons-plus"
            label="Create"
            color="fuchsia"
            class="w-1/2"
            size="sm"
            @click="modalStore.openPayPeriodModal('create')"
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
              ? 'Switch to Current Period'
              : 'Switch to Recurring'
          }`"
          color="fuchsia"
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
