<script setup>
import Modal from '@/Components/Breeze/Modal.vue';
import { ref } from 'vue';
import ModifyTask from '@/Pages/Paystubs/Partials/ModifyTask.vue';

const props = defineProps({
  task: Object,
});

const showModal = ref(false);
</script>

<template>
  <Modal :show="showModal" @close="showModal = false">
    <ModifyTask :task="task" @close="showModal = false" />
  </Modal>
  <div
    class="w-full p-4 rounded-md cursor-pointer text-black flex justify-between items-center"
    :class="{
      'bg-green-100 hover:bg-green-200': task.is_completed,
      'bg-primary-100 hover:bg-primary-300': !task.is_completed,
    }"
    @click="showModal = true"
  >
    <div>
      <h4 class="text-lg font-semibold text-black">
        {{ task.monthly_expense.expense.name }}
      </h4>
      <p>
        {{
          task.monthly_expense?.expense?.issuer ??
          `Monthly ${task.monthly_expense?.expense?.type}`
        }}
      </p>
    </div>

    <div>
      <p class="text-lg text-primary-700 font-semibold">${{ task.amount }}</p>
    </div>
  </div>
</template>
