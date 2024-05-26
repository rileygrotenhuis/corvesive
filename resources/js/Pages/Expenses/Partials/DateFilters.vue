<script setup>
import { ref } from 'vue';

const exampleDateFilters = ref([
  { label: 'All', value: 'all' },
  { label: 'Upcoming', value: 'upcoming' },
  { label: 'This Month', value: 'month' },
  { label: 'Next Month', value: 'next_month' },
]);

const selectedDateFilter = ref('all');
</script>

<template>
  <div>
    <select
      v-model="selectedDateFilter"
      class="block w-[150px] pl-3 pr-10 py-2 text-sm text-black font-semibold bg-white rounded-lg shadow-sm focus:outline-none focus:ring-primary-600"
    >
      <option
        v-for="filter in exampleDateFilters"
        :key="filter.value"
        :value="filter.value"
      >
        {{ filter.label }}
      </option>
    </select>
  </div>
</template>
