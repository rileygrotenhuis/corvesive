<script setup lang="ts">
const payPeriodStore = usePayPeriodStore();
</script>

<template>
  <div class="space-y-4">
    <div>
      <h4>Income</h4>
      <ul class="list-disc ml-4">
        <li>
          Total Paystubs: {{ payPeriodStore.metrics.income.paystubs.pretty }}
        </li>
        <li>
          Total Deposits: {{ payPeriodStore.metrics.income.deposits.pretty }}
        </li>
        <li>Total: {{ payPeriodStore.metrics.income.total.pretty }}</li>
      </ul>
    </div>
    <div>
      <h4>Expenses:</h4>
      <div class="ml-4">
        <h6>Bills:</h6>
        <ul class="list-disc ml-8">
          <li>
            Total Payed:
            {{ payPeriodStore.metrics.expenses.bills.payed.pretty }}
          </li>
          <li>
            Total Unpayed:
            {{ payPeriodStore.metrics.expenses.bills.unpayed.pretty }}
          </li>
          <li>
            Total: {{ payPeriodStore.metrics.expenses.bills.total.pretty }}
          </li>
        </ul>
      </div>
      <div class="ml-4">
        <h6>Budgets:</h6>
        <ul class="list-disc ml-8">
          <li>
            Total Balance:
            {{ payPeriodStore.metrics.expenses.budgets.total_balance.pretty }}
          </li>
          <li>
            Total Remaining:
            {{
              payPeriodStore.metrics.expenses.budgets.remaining_balance.pretty
            }}
          </li>
          <li>
            Total Spent:
            {{ payPeriodStore.metrics.expenses.budgets.spent.pretty }}
          </li>
        </ul>
      </div>
      <div class="ml-4">
        <h6>Savings:</h6>
        <ul class="list-disc ml-8">
          <li>
            Total: {{ payPeriodStore.metrics.expenses.savings.total.pretty }}
          </li>
        </ul>
      </div>
      <ul class="list-disc ml-8">
        <li>Total Spent: {{ payPeriodStore.metrics.expenses.spent.pretty }}</li>
        <li>
          Total Remaining:
          {{ payPeriodStore.metrics.expenses.remaining.pretty }}
        </li>
        <li>Total: {{ payPeriodStore.metrics.expenses.total.pretty }}</li>
      </ul>
    </div>
    <div>
      <h4>Surplus:</h4>
      <ul class="list-disc ml-4">
        <li>
          Current Surplus: {{ payPeriodStore.metrics.surplus.current.pretty }}
        </li>
        <li>
          Projected Surplus:
          {{ payPeriodStore.metrics.surplus.projected.pretty }}
        </li>
      </ul>
    </div>
  </div>
</template>
