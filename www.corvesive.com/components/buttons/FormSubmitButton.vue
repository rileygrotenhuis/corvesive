<script setup>
defineProps({
  buttonText: String,
  ghost: Boolean,
  disabled: Boolean
});
</script>

<template>
  <button
    type="submit"
    :class="`${
      ghost ? 'bg-white border border-black text-black' : 'bg-black text-white'
    } py-1 px-2 rounded-xl shadow-md hover:bg-gray-800 hover:text-white focus:outline-none focus:bg-gray-800 w-full`"
    :disabled="disabled ?? false"
  >
    {{ buttonText }}
  </button>
</template>
