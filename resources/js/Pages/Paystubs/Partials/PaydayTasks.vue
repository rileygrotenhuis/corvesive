<script setup>
import NewPaydayTask from '@/Pages/Paystubs/Partials/NewPaydayTask.vue';
import PaydayTask from '@/Pages/Paystubs/Partials/PaydayTask.vue';

defineProps({
  monthlyPaystub: Object,
  paydayTasks: Array,
  upcomingExpenses: Object,
  monthSelectionOptions: Array,
});
</script>

<template>
  <div class="bg-white p-4 rounded-md text-black">
    <div class="flex justify-between items-center mb-2">
      <h3 class="text font-semibold mb-2">Pay Day Tasks</h3>

      <NewPaydayTask
        :monthlyPaystub="monthlyPaystub"
        :paydayTasks="paydayTasks"
        :upcomingExpenses="upcomingExpenses"
        :monthSelectionOptions="monthSelectionOptions"
      />
    </div>

    <div
      class="space-y-4 max-h-[325px] md:max-h-[750px] overflow-y-auto no-scrollbar"
    >
      <PaydayTask
        v-if="paydayTasks.length > 0"
        v-for="(task, index) in paydayTasks"
        :key="index"
        :task="task"
      />

      <div v-else>
        <p class="text-gray-700 text-sm">Add your first pay day task!</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
.no-scrollbar::-webkit-scrollbar {
  display: none; /* Hide scrollbar for Chrome, Safari and Opera */
}

.no-scrollbar {
  -ms-overflow-style: none; /* IE and Edge */
  scrollbar-width: none; /* Firefox */
}
</style>
