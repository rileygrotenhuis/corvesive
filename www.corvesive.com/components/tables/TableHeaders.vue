<script setup lang="ts">
defineProps({
  headers: Array,
});
</script>

<template>
  <thead class="text-xs text-white uppercase bg-black">
    <tr>
      <th
        v-for="(header, index) in headers"
        :key="header"
        scope="col"
        class="px-6 py-3"
        :class="{
          'rounded-tl-md': index === 0,
          'rounded-tr-md': index === headers.length - 1,
        }"
      >
        {{ header }}
      </th>
    </tr>
  </thead>
</template>
