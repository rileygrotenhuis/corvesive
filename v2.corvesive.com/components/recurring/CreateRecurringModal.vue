<script setup lang="ts">
const modalStore = useModalStore();
</script>

<template>
  <UModal v-if="modalStore.recurring.open" v-model="modalStore.recurring.open">
    <div class="p-4">
      <div class="flex justify-end">
        <UIcon
          name="i-heroicons-x-mark"
          class="w-8 h-8 hover:cursor-pointer"
          @click="modalStore.closeRecurringModal()"
        />
      </div>
      <div>
        {{ modalStore.recurring.type }}
      </div>
    </div>
  </UModal>
</template>
