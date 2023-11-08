<script setup lang="ts">
defineProps({
  modelValue: String,
  type: String,
  name: String,
  disabled: Boolean,
});

const emits = defineEmits(['update:modelValue']);
</script>

<template>
  <input
    :type="type ?? 'text'"
    :id="name"
    :name="name"
    class="shadow appearance-none border rounded w-full py-2 pl-2 pr-16 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
    :disabled="disabled"
    :value="modelValue"
    @input="emits('update:modelValue', $event.target.value)"
  />
</template>
