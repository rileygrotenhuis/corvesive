<script setup>
import {ref} from "vue";
import Modal from "@/Components/Breeze/Modal.vue";

const props = defineProps({
  paydayTasks: Array,
  upcomingExpenses: Object,
});

const showModal = ref(false);
</script>

<template>
  <button
    @click.prevent="showModal = true"
    class="w-8 h-8 flex text-center justify-center items-center bg-primary-100 p-2 text-primary-1000 font-bold rounded-full hover:bg-primary-700 hover:text-primary-100 transition ease-in-out"
  >
    +
  </button>

  <Modal :show="showModal" @close="showModal = false">

  </Modal>
</template>
