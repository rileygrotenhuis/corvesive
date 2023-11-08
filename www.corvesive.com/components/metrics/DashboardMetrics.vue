<script setup lang="ts">
import usePayPeriodDashboardStore from '~/stores/payPeriodDashboard';
</script>

<template>
  <div class="flex flex-col gap-4">
    <div v-if="usePayPeriodDashboardStore().data?.upcoming_bills">
      <h3 class="font-bold">Upcoming Bills</h3>
      <ul class="list-disc ml-8">
        <li
          v-if="usePayPeriodDashboardStore().data?.upcoming_bills.length > 0"
          v-for="bill in usePayPeriodDashboardStore().data?.upcoming_bills"
        >
          {{ bill.bill.issuer }} - {{ bill.bill.name }} ({{ bill.amount.pretty }})
        </li>
        <li v-else>No upcoming Bills</li>
      </ul>
    </div>

    <div v-if="usePayPeriodDashboardStore().data?.remaining_budgets">
      <h3 class="font-bold">Remaining Budgets</h3>
      <ul class="list-disc ml-8">
        <li
          v-if="usePayPeriodDashboardStore().data?.remaining_budgets.length > 0"
          v-for="budget in usePayPeriodDashboardStore().data?.remaining_budgets"
        >
          {{ budget.budget.name }} ({{ budget.remaining_balance.pretty }})
        </li>
        <li v-else>No remaining Budgets</li>
      </ul>
    </div>

    <div v-if="usePayPeriodDashboardStore().data?.total_spent_today">
      <h3 class="font-bold">Total Spent Today</h3>
      <ul class="list-disc ml-8">
        <li>
          {{ usePayPeriodDashboardStore().data?.total_spent_today?.pretty }}
        </li>
      </ul>
    </div>
  </div>
</template>
