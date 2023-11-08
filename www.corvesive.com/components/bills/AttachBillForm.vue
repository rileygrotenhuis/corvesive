<script setup lang="ts">
import usePayPeriodBillsStore from '~/stores/payPeriodBills';
import useBillsStore from '~/stores/bills.ts';

await useBillsStore().getBills();
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Attach Bill to this Pay Period</h3>
    <form
      @submit.prevent="usePayPeriodBillsStore().attachBillToPayPeriod()"
      class="flex flex-col gap-4"
    >
      <div>
        <FormsInputLabel resource="bill" text="Select Bill" />
        <BillsBillSelection />
      </div>
      <FormsDoubleInput>
        <div>
          <FormsInputLabel resource="amount" text="Amount" />
          <FormsInputCurrency
            v-model="usePayPeriodBillsStore().form.amount"
            name="amount"
            :disabled="usePayPeriodBillsStore().form.isLoading"
          />
        </div>
        <div>
          <FormsInputLabel resource="due_date" text="Due Date" />
          <FormsInputText
            v-model="usePayPeriodBillsStore().form.dueDate"
            name="due_date"
            type="date"
            :disabled="usePayPeriodBillsStore().form.isLoading"
          />
        </div>
      </FormsDoubleInput>
      <FormsFormErrors
        v-if="usePayPeriodBillsStore().form.errors"
        :formErrors="usePayPeriodBillsStore().form.errors"
      />
      <ButtonsFormSubmitButton
        buttonText="Save"
        :disabled="usePayPeriodBillsStore().form.isLoading"
      />
    </form>
  </div>
</template>
