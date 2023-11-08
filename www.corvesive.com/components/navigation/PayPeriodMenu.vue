<script setup>
import useModalsStore from '~/stores/modals';
import usePayPeriodsStore from '~/stores/payPeriods';
import { ref, onMounted, onBeforeUnmount } from 'vue';

const isPayPeriodMenuOpen = ref(false);

onMounted(() => {
  document.addEventListener('click', closeMenuOnClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener('click', closeMenuOnClickOutside);
});

const closeMenuOnClickOutside = (event) => {
  if (
    isPayPeriodMenuOpen.value &&
    !document.querySelector('#pay-period-menu').contains(event.target)
  ) {
    isPayPeriodMenuOpen.value = false;
  }
};

const openUpdateModal = () => {
  useModalsStore().openModal('payPeriods.update');

  usePayPeriodsStore().populateFormFields();
};
</script>

<template>
  <div id="pay-period-menu" class="relative inline-block">
    <IconsSettingsIcon
      @click.prevent="isPayPeriodMenuOpen = !isPayPeriodMenuOpen"
      class="hover:cursor-pointer"
    />
    <div
      v-if="isPayPeriodMenuOpen"
      @click.prevent="isPayPeriodMenuOpen = false"
      class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
    >
      <div class="py-2 flex flex-col p-2 gap-1">
        <button
          class="font-light text-left text-sm px-1 py-2 rounded-md hover:bg-slate-200"
          @click="useModalsStore().openModal('payPeriods.create')"
        >
          New +
        </button>
        <button
          v-if="
            usePayPeriodsStore().currentPayPeriod &&
            !usePayPeriodsStore().currentPayPeriod.is_complete
          "
          :class="`font-light text-left text-sm px-1 py-2 rounded-md hover:bg-slate-200`"
          @click="openUpdateModal"
          :disabled="usePayPeriodsStore().currentPayPeriod.is_complete"
        >
          Settings
        </button>
        <button
          v-if="
            usePayPeriodsStore().currentPayPeriod &&
            usePayPeriodsStore().currentPayPeriod.is_complete
          "
          class="font-light text-left text-sm px-1 py-2 rounded-md hover:bg-slate-200"
          @click="usePayPeriodsStore().incompletePayPeriod()"
        >
          Incomplete
        </button>
        <button
          v-if="
            usePayPeriodsStore().currentPayPeriod &&
            !usePayPeriodsStore().currentPayPeriod.is_complete
          "
          class="font-light text-left text-sm px-1 py-2 rounded-md hover:bg-slate-200"
          @click="usePayPeriodsStore().completePayPeriod()"
        >
          Complete
        </button>
      </div>
    </div>
  </div>
</template>
