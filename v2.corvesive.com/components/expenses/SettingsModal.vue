<script setup lang="ts">
const modalStore = useModalStore();
</script>

<template>
  <UModal
    v-if="modalStore.settings.open"
    v-model="modalStore.settings.open"
    :ui="{ container: 'flex items-start items-top justify-center text-right' }"
  >
    <div class="p-4">
      <UIcon
        name="i-heroicons-x-mark"
        class="w-8 h-8 hover:cursor-pointer absolute top-5 right-3"
        @click="modalStore.closeSettingsModal()"
      />
      <PeriodUpdatePayPeriodBillForm
        v-if="modalStore.settings.type === 'payPeriodBill'"
      />
      <PeriodUpdatePayPeriodBudgetForm
        v-if="modalStore.settings.type === 'payPeriodBudget'"
      />
      <PeriodUpdatePayPeriodSavingForm
        v-if="modalStore.settings.type === 'payPeriodSaving'"
      />
    </div>
  </UModal>
</template>
