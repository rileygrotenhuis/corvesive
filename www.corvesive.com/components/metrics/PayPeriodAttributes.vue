<script setup lang="ts">
const payPeriodStore = usePayPeriodStore();
</script>

<template>
  <div>
    <div>
      <h4>Overdue Bills:</h4>
      <ul class="list-disc ml-4">
        <li v-for="bill in payPeriodStore.attributes.bills.overdue">
          {{ bill.bill.issuer }} - {{ bill.bill.name }} ({{
            bill.amount.pretty
          }})
        </li>
      </ul>
    </div>
    <div>
      <h4>Upcoming Bills:</h4>
      <ul class="list-disc ml-4">
        <li v-for="bill in payPeriodStore.attributes.bills.upcoming">
          {{ bill.bill.issuer }} - {{ bill.bill.name }} ({{
            bill.amount.pretty
          }})
        </li>
      </ul>
    </div>
    <div>
      <h4>Remaining Budgets:</h4>
      <ul class="list-disc ml-4">
        <li v-for="budget in payPeriodStore.attributes.budgets.remaining">
          {{ budget.budget.name }} ({{ budget.remaining_balance.pretty }})
        </li>
      </ul>
    </div>
    <div>
      <h4>Recent Transactions:</h4>
      <ul class="list-disc ml-4">
        <li
          v-for="transaction in payPeriodStore.attributes.transactions.recent"
        >
          {{ transaction.type }} - {{ transaction.amount.pretty }} ({{
            transaction.dates.created.pretty
          }})
        </li>
      </ul>
    </div>
  </div>
</template>
