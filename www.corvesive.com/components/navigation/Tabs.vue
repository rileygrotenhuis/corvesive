<script setup lang="ts">
defineProps({
  tabs: Array,
});
</script>

<template>
  <div class="text-sm font-medium text-center text-gray-500">
    <div
      class="flex overflow-x-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-100 -mb-px"
    >
      <NuxtLink
        v-for="(tab, index) in tabs"
        :key="index"
        :to="tab.url"
        :class="`inline-block p-4 mr-2 border-b-2 rounded-t-lg ${
          $route.path === tab.url
            ? 'text-blue-700 border-blue-600 active'
            : 'border-transparent hover:text-gray-600 hover:border-gray-300'
        }`"
      >
        {{ tab.text }}
      </NuxtLink>
    </div>
  </div>
</template>
