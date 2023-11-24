<script setup lang="ts">
defineProps({
  errors: Object,
});
</script>

<template>
  <div
    v-if="errors && Object.keys(errors).length > 0"
    class="bg-red-600 text-white px-4 py-2 rounded-md my-2"
  >
    <p>Oops! There was an error. Please check the following:</p>
    <ul class="list-disc list-inside">
      <li v-for="(error, index) in errors" :key="index">
        {{ error[0] }}
      </li>
    </ul>
  </div>
</template>
