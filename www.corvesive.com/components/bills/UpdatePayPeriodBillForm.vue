<script setup lang="ts">
import usePayPeriodBillsStore from '~/stores/payPeriodBills';
import usePayPeriodsStore from '~/stores/payPeriods.ts';
import useAlertsStore from '~/stores/alerts.ts';

const deletePayPeriodBill = async () => {
  if (usePayPeriodsStore().currentPayPeriod.is_complete) {
    useAlertsStore().addAlert('payPeriodIsCompleted');
    return;
  }

  if (
    window.confirm(
      'Are you sure you want to remove this bill from this pay period?'
    )
  ) {
    await usePayPeriodBillsStore().detachBillToPayPeriod(
      usePayPeriodsStore().currentPayPeriod.id,
      usePayPeriodBillsStore().selectedPayPeriodBill.id
    );
  }
};
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">
      {{ usePayPeriodBillsStore().selectedPayPeriodBill.issuer }} -
      {{ usePayPeriodBillsStore().selectedPayPeriodBill.name }}
    </h3>
    <form
      @submit.prevent="usePayPeriodBillsStore().updatePayPeriodBill()"
      class="flex flex-col gap-4"
    >
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
      <div class="flex gap-4">
        <ButtonsFormDeleteButton
          buttonText="Remove"
          :disabled="usePayPeriodBillsStore().form.isLoading"
          @click="deletePayPeriodBill"
        />
        <ButtonsFormSubmitButton
          buttonText="Save"
          :disabled="usePayPeriodBillsStore().form.isLoading"
        />
      </div>
    </form>
  </div>
</template>
