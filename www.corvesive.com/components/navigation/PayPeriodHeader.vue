<script setup>
import useModalsStore from "~/stores/modals";
import usePayPeriodsStore from "~/stores/payPeriods";
</script>

<template>
  <div class="flex justify-between items-center">
    <div
      class="flex gap-4 rounded-md p-2 hover:cursor-pointer hover:bg-gray-200"
      @click.prevent="useModalsStore().openModal('payPeriods.select')"
    >
      <IconsCalendarIcon class="my-auto" />
      <div class="my-auto">
        <h3
          class="text-sm inline-block md:hidden"
          v-if="usePayPeriodsStore().currentPayPeriod"
        >
          {{
            usePayPeriodsStore().currentPayPeriod?.dates.start.pretty.short
          }}
          -
          {{ usePayPeriodsStore().currentPayPeriod?.dates.end.pretty.short }}
        </h3>
        <h3
          class="text-lg hidden md:inline-block"
          v-if="usePayPeriodsStore().currentPayPeriod"
        >
          {{ usePayPeriodsStore().currentPayPeriod?.dates.start.pretty.full }} -
          {{ usePayPeriodsStore().currentPayPeriod?.dates.end.pretty.full }}
        </h3>
        <h3 v-else class="text-lg hidden md:inline-block">
          Select a Pay Period to get started
        </h3>
      </div>
    </div>
    <div class="flex gap-8">
      <NavigationTransactionsMenu
        v-if="
          usePayPeriodsStore().currentPayPeriod &&
          !usePayPeriodsStore().currentPayPeriod.is_complete
        "
      />
      <NavigationPayPeriodMenu />
    </div>
  </div>
</template>
