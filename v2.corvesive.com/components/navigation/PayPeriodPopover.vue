<template>
  <UPopover :popper="{ placement: 'bottom-end' }">
    <UIcon name="i-heroicons-calendar" class="w-5 h-5" />

    <template #panel>
      <div class="p-4">
        <div>Testing</div>
      </div>
    </template>
  </UPopover>
</template>
