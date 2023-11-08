<script setup>
import usePayPeriodPaystubsStore from "~/stores/payPeriodPaystubs";
import usePayPeriodsStore from "~/stores/payPeriods.js";
import useAlertsStore from "~/stores/alerts.js";

const deletePayPeriodPaystub = async () => {
  if (usePayPeriodsStore().currentPayPeriod.is_complete) {
    useAlertsStore().addAlert("payPeriodIsCompleted");
    return;
  }

  if (
    window.confirm(
      "Are you sure you want to remove this paystub from this pay period?",
    )
  ) {
    await usePayPeriodPaystubsStore().detachPaystubFromPayPeriod(
      usePayPeriodsStore().currentPayPeriod.id,
      usePayPeriodPaystubsStore().selectedPayPeriodPaystub.id,
    );
  }
};
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">
      {{ usePayPeriodPaystubsStore().selectedPayPeriodPaystub.issuer }}
    </h3>
    <form
      @submit.prevent="usePayPeriodPaystubsStore().updatePayPeriodPaystub()"
      class="flex flex-col gap-4"
    >
      <div>
        <FormsInputLabel resource="amount" text="Amount" />
        <FormsInputCurrency
          v-model="usePayPeriodPaystubsStore().form.amount"
          name="total_balance"
          :disabled="usePayPeriodPaystubsStore().form.isLoading"
        />
      </div>
      <FormsFormErrors
        v-if="usePayPeriodPaystubsStore().form.errors"
        :formErrors="usePayPeriodPaystubsStore().form.errors"
      />
      <div class="flex gap-4">
        <ButtonsFormDeleteButton
          buttonText="Remove"
          :disabled="usePayPeriodPaystubsStore.isLoading"
          @click="deletePayPeriodPaystub"
        />
        <ButtonsFormSubmitButton
          buttonText="Save"
          :disabled="usePayPeriodPaystubsStore().form.isLoading"
        />
      </div>
    </form>
  </div>
</template>
