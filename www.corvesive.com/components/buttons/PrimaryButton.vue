<script setup lang="ts">
defineProps({
  buttonText: String,
  buttonColor: String,
});
</script>

<template>
  <button
    :class="`${
      buttonColor ?? 'bg-rose-500'
    } text-white px-4 py-1 rounded-xl min-w-[100px] shadow-md hover:bg-gray-800 focus:outline-none focus:bg-black`"
  >
    {{ buttonText }}
  </button>
</template>
