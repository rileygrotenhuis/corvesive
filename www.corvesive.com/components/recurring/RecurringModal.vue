<script setup lang="ts">
const modalStore = useModalStore();
</script>

<template>
  <UModal
    v-if="modalStore.recurring.open"
    v-model="modalStore.recurring.open"
    :ui="{ container: 'flex items-start items-top justify-center text-right' }"
  >
    <div class="p-4">
      <UIcon
        name="i-heroicons-x-mark"
        class="w-8 h-8 hover:cursor-pointer absolute top-5 right-3"
        @click="modalStore.closeRecurringModal()"
      />
      <RecurringCreatePaystubForm
        v-if="modalStore.recurring.type === 'paystubs'"
      />
      <RecurringCreateBillForm v-if="modalStore.recurring.type === 'bills'" />
      <RecurringCreateBudgetForm
        v-if="modalStore.recurring.type === 'budgets'"
      />
      <RecurringCreateSavingForm
        v-if="modalStore.recurring.type === 'savings'"
      />
    </div>
  </UModal>
</template>
