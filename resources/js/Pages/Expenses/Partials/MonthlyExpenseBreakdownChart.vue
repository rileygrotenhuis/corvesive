<script setup>
import Chart from 'chart.js/auto';
import { onMounted } from 'vue';

const props = defineProps({
  chart: Object,
});

onMounted(() => {
  const ctx = document.getElementById('expenseBreakdownChart');
  new Chart(ctx, {
    type: 'pie',
    data: props.chart,
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          labels: {
            color: 'white',
            font: {
              size: 14,
            },
          },
        },
      },
    },
  });
});
</script>

<template>
  <div>
    <canvas id="expenseBreakdownChart" width="400" height="400"></canvas>
  </div>
</template>
