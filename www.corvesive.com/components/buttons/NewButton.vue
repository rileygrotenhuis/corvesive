<script setup>
defineProps({
  buttonColor: String,
});
</script>

<template>
  <button
    :class="`${
      buttonColor ?? 'bg-rose-500'
    } text-white font-light text-2xl rounded-full w-[32px] h-[32px] shadow-2xl hover:bg-gray-800 focus:outline-none focus:bg-black`"
  >
    +
  </button>
</template>
