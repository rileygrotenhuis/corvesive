<script setup>
defineProps({
  rowColor: {
    type: String,
    default: "bg-white",
  },
});
</script>

<template>
  <tr
    :class="`hover:bg-gray-50 hover:cursor-pointer border-b text-black ${rowColor}`"
  >
    <slot />
  </tr>
</template>
