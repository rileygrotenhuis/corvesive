<script setup lang="ts">
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets';
import usePayPeriodsStore from '~/stores/payPeriods.ts';

const deletePayPeriodBudget = async () => {
  if (usePayPeriodsStore().currentPayPeriod.is_complete) {
    return;
  }

  if (
    window.confirm(
      'Are you sure you want to remove this budget from this pay period?'
    )
  ) {
    await usePayPeriodBudgetsStore().detachBudgetToPayPeriod(
      usePayPeriodsStore().currentPayPeriod.id,
      usePayPeriodBudgetsStore().selectedPayPeriodBudget.id
    );
  }
};
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">
      {{ usePayPeriodBudgetsStore().selectedPayPeriodBudget.name }}
    </h3>
    <form
      @submit.prevent="usePayPeriodBudgetsStore().updatePayPeriodBudget()"
      class="flex flex-col gap-4"
    >
      <FormsDoubleInput>
        <div>
          <FormsInputLabel resource="total_balance" text="Total Balance" />
          <FormsInputCurrency
            v-model="usePayPeriodBudgetsStore().form.totalBalance"
            name="total_balance"
            :disabled="usePayPeriodBudgetsStore().form.isLoading"
          />
        </div>
        <div>
          <FormsInputLabel
            resource="remaining_balance"
            text="Remaining Balance"
          />
          <FormsInputCurrency
            v-model="usePayPeriodBudgetsStore().form.remainingBalance"
            name="remaining_balance"
            :disabled="usePayPeriodBudgetsStore().form.isLoading"
          />
        </div>
      </FormsDoubleInput>
      <FormsFormErrors
        v-if="usePayPeriodBudgetsStore().form.errors"
        :formErrors="usePayPeriodBudgetsStore().form.errors"
      />
      <div class="flex gap-4">
        <ButtonsFormDeleteButton
          buttonText="Remove"
          :disabled="usePayPeriodBudgetsStore().form.isLoading"
          @click="deletePayPeriodBudget"
        />
        <ButtonsFormSubmitButton
          buttonText="Save"
          :disabled="usePayPeriodBudgetsStore().form.isLoading"
        />
      </div>
    </form>
  </div>
</template>
