<script setup>
import { ref } from 'vue';

defineProps({
  selectedType: String,
});

defineEmits(['updateSelectedType']);

const types = ref(['All', 'Bill', 'Budget', 'Saving']);
</script>

<template>
  <div>
    <select
      :value="selectedType"
      class="block pl-3 py-2 text-sm text-black font-semibold bg-primary-100 rounded-lg shadow-sm focus:outline-none focus:ring-primary-600"
      @change.prevent="$emit('updateSelectedType', $event.target.value)"
    >
      <option v-for="type in types" :key="type" :value="type">
        {{ type }}
      </option>
    </select>
  </div>
</template>
