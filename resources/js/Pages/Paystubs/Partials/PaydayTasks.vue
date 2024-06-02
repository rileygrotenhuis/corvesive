<script setup>
defineProps({
  paydayTasks: Array,
  upcomingExpenses: Object,
});
</script>

<template>
  <div class="bg-white p-4 rounded-md text-black">
    <div class="space-y-4">
      <div
        v-for="(task, index) in paydayTasks"
        :key="index"
        class="w-full bg-primary-100 hover:bg-primary-300 p-4 rounded-md cursor-pointer text-black flex justify-between items-center"
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
          <p class="text-lg text-primary-700 font-semibold">
            ${{ task.amount }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>
