<script setup>
defineProps({
  modelValue: String,
  name: String,
  disabled: Boolean,
});

const emits = defineEmits(["update:modelValue"]);
</script>

<template>
  <div class="flex">
    <span class="-mr-4 z-0 flex items-center pl-2 text-gray-600"> $ </span>
    <input
      type="number"
      step="0.01"
      :id="name"
      :name="name"
      class="shadow appearance-none border rounded w-full py-2 pl-4 pr-14 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
      :disabled="disabled"
      :value="modelValue"
      @input="emits('update:modelValue', $event.target.value)"
    />
  </div>
</template>
