<script setup>
defineProps({
  formErrors: Object
});
</script>

<template>
  <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md my-2">
    <p>Oops! There was an error. Please check the following:</p>
    <ul class="list-disc list-inside">
      <li v-for="(error, index) in formErrors" :key="index">
        {{ error[0] }}
      </li>
    </ul>
  </div>
</template>
