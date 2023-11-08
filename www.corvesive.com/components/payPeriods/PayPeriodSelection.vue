<script setup>
import { ref, onMounted } from 'vue';
import usePayPeriodsStore from '~/stores/payPeriods.js';
import useModalsStore from '~/stores/modals.js';
import useAlertsStore from '~/stores/alerts.js';

onMounted(async () => {
  await usePayPeriodsStore().getPayPeriods();

  if (usePayPeriodsStore().payPeriods.length === 0) {
    useAlertsStore().addAlert('noPayPeriodsAvailable');
    useModalsStore().setModalType('payPeriods.create');
  }
});

const selectedPayPeriod = ref(usePayPeriodsStore()?.currentPayPeriod?.id ?? undefined);
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto text-center">
    <h3 class="text-3xl font-bold mb-1">Select Pay Period</h3>
    <p class="text-xs font-light mb-4">
      Select the pay period that you wish to use for your current dashboard.
    </p>
    <div class="mb-4 flex flex-col gap-2 justify-center">
      <button
        :class="`font-light px-4 py-2 rounded-md hover:bg-slate-200 ${
          selectedPayPeriod === payPeriod.id ? 'bg-slate-200' : null
        }`"
        v-for="payPeriod in usePayPeriodsStore().payPeriods"
        :key="payPeriod.id"
        @click.prevent="selectedPayPeriod = payPeriod.id"
      >
        <span class="hidden md:inline-block">
          {{ payPeriod.dates.start.pretty.full }} - {{ payPeriod.dates.end.pretty.full }}
        </span>
        <span class="inline-block md:hidden">
          {{ payPeriod.dates.start.pretty.short }} - {{ payPeriod.dates.end.pretty.short }}
        </span>
      </button>
    </div>
    <button
      :class="`text-white py-1 px-2 rounded-xl shadow-md hover:bg-gray-800 focus:outline-none focus:bg-gray-800 w-full ${
        !selectedPayPeriod ? 'bg-gray-200' : 'bg-black'
      }`"
      :disabled="!selectedPayPeriod"
      @click.prevent="usePayPeriodsStore().setPayPeriodToCurrent(selectedPayPeriod)"
    >
      Select
    </button>
  </div>
</template>
