<script setup>
import useModalsStore from "~/stores/modals.js";

defineProps({
  icon: Object,
  title: String,
  subtext: String,
  buttonColor: String,
  modalKey: String,
});
</script>

<template>
  <div>
    <div class="flex justify-between mb-4">
      <div class="flex gap-2 my-auto">
        <component :is="icon" class="my-auto" />
        <h3 class="text-2xl font-bold">{{ title }}</h3>
      </div>
      <ButtonsNewButton
        v-if="modalKey"
        :buttonColor="buttonColor"
        @click.prevent="useModalsStore().openModal(modalKey)"
      />
    </div>
    <p class="text-sm md:text-base font-light mb-4 w-full max-w-[700px]">
      {{ subtext }}
    </p>
  </div>
</template>
