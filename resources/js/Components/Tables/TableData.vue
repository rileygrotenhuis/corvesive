<script setup>
defineProps({
  value: String,
});
</script>

<template>
  <td class="px-6 py-4 whitespace-nowrap">
    <div class="text-sm text-white">
      {{ value }}
    </div>
  </td>
</template>
