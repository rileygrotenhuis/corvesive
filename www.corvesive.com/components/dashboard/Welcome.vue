<script setup>
import useAccountStore from '~/stores/account.js';

const getStarted = async () => {
  await useAccountStore().onboardUser();
};
</script>

<template>
  <div class="flex flex-col gap-8 mt-8">
    <div class="flex flex-col gap-2">
      <h2 class="text-3xl font-bold">Welcome to Corvesive!</h2>
      <p class="text-sm">
        Corvesive is a budgeting application that allows you to closer track
        your monthly finances into customizable segments of time.
      </p>
    </div>
    <div class="flex flex-col gap-2">
      <button
        class="w-fit py-1 px-4 bg-gray-300 text-gray-800 rounded-lg"
        @click.prevent="getStarted"
      >
        Skip
      </button>
      <h3 class="text-lg font-bold">
        Organize your Monthly Income and Expenses
      </h3>
      <p class="font-light">
        To get started with Corvesive, switch to the
        <router-link
          class="text-blue-500 hover:text-blue-700 font-medium underline"
          to="/monthly"
          >Monthly View</router-link
        >
        and track your monthly income and expenses with Paystubs, Budgets, and
        Bills.
      </p>
      <div class="flex flex-col gap-2 pl-8">
        <p>
          <router-link class="font-bold" to="/monthly/bills"
            >Paystubs -</router-link
          >
          represent a stream of income that you have during a given month. This
          could be anything from a paycheck, profit from rental properties, loan
          amounts, you name it. To create a Paystub you only need to provide an
          issuer, an amount, and optional notes.
        </p>
        <p>
          <router-link class="font-bold" to="/monthly/bills"
            >Bills -</router-link
          >
          represent a one-time payment expense that you may have in a given
          month. This could be anything like rent, utilities, auto insurance,
          and more. The only information you need to provide for a Bill is an
          issuer, a name, an amount field, and the day of the month that it is
          due.
        </p>
        <p>
          <router-link class="font-bold" to="/monthly/bills"
            >Budgets -</router-link
          >
          represent a total balance that you have to spend for a specific
          financial category in a given month. A Budget represents an expense
          that isn't paid in full at one time, but rather subtracted from slowly
          over the course of time. Some examples of these categories could
          include, but are not limited to: groceries, gas, insurance, and
          entertainment. The only information you need to provide for a Budget
          is a name and a total balance.
        </p>
      </div>
    </div>
    <div class="flex flex-col gap-2">
      <h3 class="text-lg font-bold">Zoom In to Custom Pay Periods</h3>
      <p>
        To keep track and better organize your expenses for a custom segment of
        time, create a new Pay Period with a valid start and end date. After
        creating a Pay Period you can attach any of your monthly Paystubs,
        Bills, or Budgets to keep track of with more specific amounts and due
        dates.
      </p>
    </div>
    <div class="flex flex-col gap-2">
      <h3 class="text-lg font-bold">Track Metrics with Transactions</h3>
      <p>
        Make Transactions for your currently selected Pay Period to better
        report and gather accurate metrics for you to review. To make a
        Transaction you will simply select the expense that you are making the
        Transaction for and add an amount if it is for a Budget. You may also
        make a Deposit to your Pay Period if you've received any extra funds
        outside of your normal Paystubs.
      </p>
      <p>
        Corvesive aggregates all of your Transactions for a given Pay Period to
        calculate a series of Metrics that are displayed for your on the
        <router-link
          class="text-blue-500 hover:text-blue-700 font-medium underline"
          to="/dashboard"
          >Dashboard</router-link
        >
        as well as the
        <router-link
          class="text-blue-500 hover:text-blue-700 font-medium underline"
          to="/dashboard/metrics"
          >Metrics View</router-link
        >
      </p>
    </div>
    <button
      class="w-fit py-2 px-4 bg-blue-700 text-white rounded-lg"
      @click.prevent="getStarted"
    >
      Get Started
    </button>
  </div>
</template>
