<script setup>
defineProps({
  data: Object,
});
</script>

<template>
  <div class="bg-gray-800 rounded-lg shadow-lg w-3/4 md:w-1/4">
    <h3 class="text-white text-center p-6 font-bold text-2xl mb-4">
      Income Breakdown
    </h3>
    <ul class="px-6">
      <li
        v-for="(key, index) in Object.keys(data)"
        :key="index"
        class="flex justify-between mb-2 text-lg"
      >
        <span class="text-gray-300">{{ data[key].issuer }}</span>
        <span class="text-white">{{ data[key].total }}</span>
      </li>
    </ul>
    <div class="bg-gray-700 p-4 rounded-b-lg">
      <h4 class="text-white font-bold">
        Total: <span class="float-right">{{ data.total }}</span>
      </h4>
    </div>
  </div>
</template>
