<script setup lang="ts">
import useMonthlyMetricsStore from '~/stores/monthlyMetrics.js';
</script>

<template>
  <div class="flex flex-col gap-4">
    <div
      v-if="
        useMonthlyMetricsStore().metrics &&
        useMonthlyMetricsStore().metrics.expense_metrics
      "
    >
      <h3 class="font-bold">Expenses</h3>
      <ul class="list-disc ml-8">
        <li>
          Total Bills:
          {{ useMonthlyMetricsStore().metrics.expense_metrics.bills.pretty }}
        </li>
        <li>
          Total Budgets:
          {{ useMonthlyMetricsStore().metrics.expense_metrics.budgets.pretty }}
        </li>
        <li>
          Total:
          {{ useMonthlyMetricsStore().metrics.expense_metrics.total.pretty }}
        </li>
      </ul>
    </div>

    <div
      v-if="
        useMonthlyMetricsStore().metrics &&
        useMonthlyMetricsStore().metrics.income_metrics
      "
    >
      <h3 class="font-bold">Income</h3>
      <ul class="list-disc ml-8">
        <li>
          Total Paystubs:
          {{
            useMonthlyMetricsStore().metrics.income_metrics.paystubs_total
              .pretty
          }}
        </li>
      </ul>
    </div>

    <div
      v-if="
        useMonthlyMetricsStore().metrics &&
        useMonthlyMetricsStore().metrics.surplus_metrics
      "
    >
      <h3 class="font-bold">Surplus</h3>
      <ul class="list-disc ml-8">
        <li>
          Projected Surplus:
          {{
            useMonthlyMetricsStore().metrics.surplus_metrics.projected.pretty
          }}
        </li>
      </ul>
    </div>
  </div>
</template>
