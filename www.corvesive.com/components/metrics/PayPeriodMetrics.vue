<script setup>
import usePayPeriodMetricsStore from '~/stores/payPeriodMetrics.js';
</script>

<template>
  <div class="flex flex-col gap-4">
    <div
      v-if="usePayPeriodMetricsStore().metrics && usePayPeriodMetricsStore().metrics.bill_metrics"
    >
      <h3 class="font-bold">Bills</h3>
      <ul class="list-disc ml-8">
        <li>
          Total Payed: {{ usePayPeriodMetricsStore().metrics.bill_metrics.total_payed.pretty }}
        </li>
        <li>
          Total Unpayed: {{ usePayPeriodMetricsStore().metrics.bill_metrics.total_unpayed.pretty }}
        </li>
        <li>Total: {{ usePayPeriodMetricsStore().metrics.bill_metrics.total.pretty }}</li>
      </ul>
    </div>

    <div
      v-if="usePayPeriodMetricsStore().metrics && usePayPeriodMetricsStore().metrics.budget_metrics"
    >
      <h3 class="font-bold">Budgets</h3>
      <ul class="list-disc ml-8">
        <li>
          Total Balance:
          {{ usePayPeriodMetricsStore().metrics.budget_metrics.total_balance.pretty }}
        </li>
        <li>
          Remaining Balance:
          {{ usePayPeriodMetricsStore().metrics.budget_metrics.remaining_balance.pretty }}
        </li>
      </ul>
    </div>

    <div
      v-if="usePayPeriodMetricsStore().metrics && usePayPeriodMetricsStore().metrics.income_metrics"
    >
      <h3 class="font-bold">Income</h3>
      <ul class="list-disc ml-8">
        <li>
          Total Paystubs:
          {{ usePayPeriodMetricsStore().metrics.income_metrics.total_paystubs.pretty }}
        </li>
        <li>
          Total Income: {{ usePayPeriodMetricsStore().metrics.income_metrics.total_income.pretty }}
        </li>
      </ul>
    </div>

    <div
      v-if="
        usePayPeriodMetricsStore().metrics && usePayPeriodMetricsStore().metrics.transaction_metrics
      "
    >
      <h3 class="font-bold">Transactions</h3>
      <ul class="list-disc ml-8">
        <li>
          Total Spent (bills):
          {{ usePayPeriodMetricsStore().metrics.transaction_metrics.total_spent.bills.pretty }}
        </li>
        <li>
          Total Spent (budgets):
          {{ usePayPeriodMetricsStore().metrics.transaction_metrics.total_spent.budgets.pretty }}
        </li>
        <li>
          Total Spent (total):
          {{ usePayPeriodMetricsStore().metrics.transaction_metrics.total_spent.total.pretty }}
        </li>
        <li>
          Total Deposited:
          {{ usePayPeriodMetricsStore().metrics.transaction_metrics.total_deposited.pretty }}
        </li>
      </ul>
    </div>

    <div
      v-if="
        usePayPeriodMetricsStore().metrics && usePayPeriodMetricsStore().metrics.surplus_metrics
      "
    >
      <h3 class="font-bold">Surplus</h3>
      <ul class="list-disc ml-8">
        <li>
          Current Surplus: {{ usePayPeriodMetricsStore().metrics.surplus_metrics.current.pretty }}
        </li>
        <li>
          Projected Surplus:
          {{ usePayPeriodMetricsStore().metrics.surplus_metrics.projected.pretty }}
        </li>
      </ul>
    </div>
  </div>
</template>
