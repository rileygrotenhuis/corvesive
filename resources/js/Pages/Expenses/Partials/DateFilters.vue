<script setup>
import { ref } from 'vue';

defineProps({
  selectedDateRange: String
});

defineEmits(['updateSelectedDateFilter']);

const exampleDateFilters = ref([
  { label: 'All', value: 'all' },
  { label: 'Upcoming', value: 'upcoming' },
  { label: 'This Month', value: 'thisMonth' },
  { label: 'Next Month', value: 'nextMonth' },
]);
</script>

<template>
  <div>
    <select
      :value="selectedDateRange"
      class="block w-[150px] pl-3 pr-10 py-2 text-sm text-black font-semibold bg-primary-100 rounded-lg shadow-sm focus:outline-none focus:ring-primary-600"
      @change.prevent="$emit('updateSelectedDateFilter', $event.target.value)"
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
