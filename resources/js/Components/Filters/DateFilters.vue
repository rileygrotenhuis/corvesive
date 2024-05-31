<script setup>
defineProps({
  selectedMonth: String,
  monthSelectionOptions: Array,
});

defineEmits(['updateSelectedMonth']);
</script>

<template>
  <div>
    <select
      v-if="monthSelectionOptions.length > 0"
      :value="selectedMonth"
      class="block pl-3 py-2 text-xs text-black font-semibold bg-primary-100 rounded-lg shadow-sm focus:outline-none focus:ring-primary-600"
      @change.prevent="$emit('updateSelectedMonth', $event.target.value)"
    >
      <option
        v-for="month in monthSelectionOptions"
        :key="month.value"
        :value="month.value"
      >
        {{ month.label }}
      </option>
    </select>
  </div>
</template>
