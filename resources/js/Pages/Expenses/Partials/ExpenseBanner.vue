<script setup>
defineProps({
  issuer: String,
  name: String,
  amount: Number,
  dueDate: String,
  notes: String,
});
</script>

<template>
  <div
    class="max-w-[750px] bg-primary-100 hover:bg-primary-300 text-black cursor-pointer hover:shadow-lg border border-gray-200 p-6 rounded-xl transition-transform transform hover:scale-105 ease-in-out"
  >
    <div class="flex justify-between items-center">
      <div>
        <h2 class="text-xl font-bold text-gray-800">
          {{ name }}
        </h2>
        <h4 class="text-md font-medium text-gray-600">
          {{ issuer }}
        </h4>
      </div>

      <div class="text-right">
        <p class="text-2xl font-bold text-primary-700">${{ amount }}</p>
        <p class="text-md font-medium text-gray-500">Due: {{ dueDate }}</p>
      </div>
    </div>

    <div class="mt-4 text-gray-700 text-md">
      {{ notes }}
    </div>
  </div>
</template>
