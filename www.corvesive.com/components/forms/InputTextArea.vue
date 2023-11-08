<script setup lang="ts">
defineProps({
  modelValue: String,
  name: String,
  disabled: Boolean,
  rows: Number,
});

const emits = defineEmits(['update:modelValue']);
</script>

<template>
  <textarea
    :rows="rows ?? 6"
    :id="name"
    :name="name"
    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
    :disabled="disabled"
    :value="modelValue"
    @input="emits('update:modelValue', $event.target.value)"
  />
</template>
