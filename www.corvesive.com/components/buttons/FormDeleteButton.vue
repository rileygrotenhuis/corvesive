<script setup>
defineProps({
  buttonText: String,
  disabled: Boolean
});
</script>

<template>
  <button
    type="button"
    class="bg-red-500 text-white py-1 px-2 rounded-xl shadow-md hover:bg-red-200 focus:outline-none focus:bg-red-200 w-full"
    :disabled="disabled ?? false"
  >
    {{ buttonText }}
  </button>
</template>
