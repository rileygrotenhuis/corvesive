<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
  type: String,
  required: true,
});

const input = ref(null);

onMounted(() => {
  if (input.value.hasAttribute('autofocus')) {
    input.value.focus();
  }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
  <input
    class="border-gray-700 bg-zinc-900 text-white focus:border-indigo-600 focus:ring-indigo-600 rounded-md shadow-sm"
    v-model="model"
    ref="input"
  />
</template>
