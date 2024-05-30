<script setup>
defineProps({
  selectedOption: String,
});

defineEmits(['updateExpenseToggle']);
</script>

<template>
  <div class="relative w-48 bg-gray-300 rounded-full p-1 flex items-center">
    <div
      :class="{
        'translate-x-0': selectedOption === 'due',
        'translate-x-full': selectedOption === 'all',
      }"
      class="absolute left-0 top-0 w-1/2 h-full bg-primary-800 rounded-full transition-transform duration-300"
    ></div>
    <button
      @click.prevent="$emit('updateExpenseToggle', 'due')"
      class="relative z-10 w-1/2 h-full focus:outline-none"
    >
      <span
        :class="{
          'text-white': selectedOption === 'due',
          'text-gray-700': selectedOption !== 'due',
        }"
      >
        Due
      </span>
    </button>
    <button
      @click.prevent="$emit('updateExpenseToggle', 'all')"
      class="relative z-10 w-1/2 h-full focus:outline-none"
    >
      <span
        :class="{
          'text-white': selectedOption === 'all',
          'text-gray-700': selectedOption !== 'all',
        }"
      >
        All
      </span>
    </button>
  </div>
</template>
