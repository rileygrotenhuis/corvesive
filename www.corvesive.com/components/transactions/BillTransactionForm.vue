<script setup>
import useTransactionsStore from "~/stores/transactions";
import usePayPeriodBillsStore from "~/stores/payPeriodBills.js";

await usePayPeriodBillsStore().getPayPeriodBills();
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Bill Transaction</h3>
    <form
      @submit.prevent="useTransactionsStore().createBillTransaction()"
      class="flex flex-col gap-4"
    >
      <div>
        <FormsInputLabel resource="expense_type" text="Select Bill" />
        <select
          v-model="useTransactionsStore().form.payPeriodExpense"
          class="shadow border rounded w-full py-2 pl-2 pr-16 text-gray-700 leading-tight focus:outline-none focus:shadow-outline-blue focus:border-blue-300"
        >
          <option
            v-for="bill in usePayPeriodBillsStore().payPeriodBills"
            :key="bill.id"
            :value="bill"
            :disabled="bill.has_payed"
          >
            {{ bill.bill.issuer }} - {{ bill.bill.name }}
          </option>
        </select>
      </div>
      <div class="flex flex-col gap-4">
        <h5 class="text-lg">
          <strong>Due Date: </strong>
          {{
            useTransactionsStore().form.payPeriodExpense?.dates?.due?.pretty
              ?.short ?? "--/--/--"
          }}
        </h5>
        <h5 class="text-lg">
          <strong>Amount: </strong>
          {{
            useTransactionsStore().form.payPeriodExpense?.amount?.pretty ??
            "$0.00"
          }}
        </h5>
      </div>
      <FormsFormErrors
        v-if="useTransactionsStore().form.errors"
        :formErrors="useTransactionsStore().form.errors"
      />
      <ButtonsFormSubmitButton
        buttonText="Pay Bill"
        :disabled="useTransactionsStore().form.isLoading"
      />
    </form>
  </div>
</template>
