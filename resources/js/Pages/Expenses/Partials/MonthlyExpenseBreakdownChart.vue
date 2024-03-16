<script setup>
import Chart from 'chart.js/auto';
import { onMounted } from 'vue';

const props = defineProps({
  monthlyExpenseBreakdown: Object,
});

const chartData = {
  labels: props.monthlyExpenseBreakdown.labels,
  datasets: [
    {
      label: 'Monthly Expense Breakdown',
      data: Object.values(props.monthlyExpenseBreakdown.data),
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)',
      ],
      hoverOffset: 4,
    },
  ],
};

onMounted(() => {
  const ctx = document.getElementById('monthlyExpenseChart');
  new Chart(ctx, {
    type: 'pie',
    data: chartData,
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
    <canvas id="monthlyExpenseChart" width="400" height="400"></canvas>
  </div>
</template>
