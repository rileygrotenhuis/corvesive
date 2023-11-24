<script setup lang="ts">
const modalStore = useModalStore();
</script>

<template>
  <UModal
    v-if="modalStore.period.open"
    v-model="modalStore.period.open"
    :ui="{ container: 'flex items-start items-top justify-center text-right' }"
  >
    <div class="p-4">
      <UIcon
        name="i-heroicons-x-mark"
        class="w-8 h-8 hover:cursor-pointer absolute top-5 right-3"
        @click="modalStore.closePeriodModal()"
      />
      <PeriodAttachPaystubForm v-if="modalStore.period.type === 'paystubs'" />
      <PeriodAttachBillForm v-if="modalStore.period.type === 'bills'" />
      <PeriodAttachBudgetForm v-if="modalStore.period.type === 'budgets'" />
      <PeriodAttachSavingForm v-if="modalStore.period.type === 'savings'" />
    </div>
  </UModal>
</template>
