<script setup lang="ts">
const modalStore = useModalStore();
</script>

<template>
  <UModal
    v-if="modalStore.transactions.open"
    v-model="modalStore.transactions.open"
    :ui="{ container: 'flex items-start items-top justify-center text-right' }"
  >
    <div class="p-4">
      <UIcon
        name="i-heroicons-x-mark"
        class="w-8 h-8 hover:cursor-pointer absolute top-5 right-3"
        @click="modalStore.closeTransactionsModal()"
      />
      <TransactionsTransactionStart
        v-if="modalStore.transactions.type === 'start'"
      />
      <TransactionsDepositTransactionForm
        v-if="modalStore.transactions.type === 'deposit'"
      />
    </div>
  </UModal>
</template>
