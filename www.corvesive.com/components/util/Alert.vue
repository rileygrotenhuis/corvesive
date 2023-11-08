<script setup>
import useAlertsStore from '~/stores/alerts.js';

const getToastClass = (type) => {
  if (type === 'info') {
    return 'bg-blue-100 border-blue-400 text-blue-700';
  } else if (type === 'warning') {
    return 'bg-yellow-100 border-yellow-400 text-yellow-700';
  } else if (type === 'error') {
    return 'bg-red-100 border-red-400 text-red-700';
  } else if (type === 'success') {
    return 'bg-green-100 border-green-400 text-green-700';
  }
};
</script>

<template>
  <div
    v-for="(alert, index) in useAlertsStore().alerts"
    :key="index"
    :class="[
      getToastClass(alert.type),
      'fixed top-5 left-5 p-4 rounded-md shadow-lg flex max-w-lg z-50',
    ]"
  >
    <button
      @click.prevent="useAlertsStore().removeAlert(index)"
      class="text-gray-400 hover:text-gray-600 mr-3 focus:outline-none focus:text-gray-600"
    >
      X
    </button>
    <div class="flex items-center">
      <div>
        <p class="text-sm font-medium">{{ alert.message }}</p>
      </div>
    </div>
  </div>
</template>
