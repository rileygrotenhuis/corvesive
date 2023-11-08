<script setup>
import useModalsStore from "~/stores/modals";
import { ref, onMounted, onBeforeUnmount } from "vue";

const isTransactionsMenuOpen = ref(false);

onMounted(() => {
  document.addEventListener("click", closeMenuOnClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", closeMenuOnClickOutside);
});

const closeMenuOnClickOutside = (event) => {
  if (
    isTransactionsMenuOpen.value &&
    !document.querySelector("#transactions-dropdown").contains(event.target)
  ) {
    isTransactionsMenuOpen.value = false;
  }
};
</script>

<template>
  <div id="transactions-dropdown" class="relative inline-block">
    <IconsPaymentIcon
      @click.prevent="isTransactionsMenuOpen = !isTransactionsMenuOpen"
      class="hover:cursor-pointer"
    />
    <div
      v-if="isTransactionsMenuOpen"
      @click.prevent="isTransactionsMenuOpen = false"
      class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
    >
      <div class="py-2 flex flex-col p-2 gap-1">
        <button
          class="font-light text-left text-sm px-1 py-2 rounded-md hover:bg-slate-200"
          @click="useModalsStore().openModal('transactions.budget')"
        >
          Pay Budget
        </button>
        <button
          class="font-light text-left text-sm px-1 py-2 rounded-md hover:bg-slate-200"
          @click="useModalsStore().openModal('transactions.bill')"
        >
          Pay Bill
        </button>
        <button
          class="font-light text-left text-sm px-1 py-2 rounded-md hover:bg-slate-200"
          @click="useModalsStore().openModal('transactions.deposit')"
        >
          Deposit
        </button>
      </div>
    </div>
  </div>
</template>
