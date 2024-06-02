<script setup>
defineProps({
  expenses: Object,
  paystubs: Object,
});
</script>

<template>
  <div class="w-full md:w-fit bg-white p-2 rounded-md">
    <div>
      {{ JSON.stringify(expenses) }}
    </div>
    <div>
      {{ JSON.stringify(paystubs) }}
    </div>
  </div>
</template>
