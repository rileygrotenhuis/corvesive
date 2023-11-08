<script setup lang="ts">
import usePayPeriodPaystubsStore from '~/stores/payPeriodPaystubs.js';
import usePaystubsStore from '~/stores/paystubs.js';

await usePaystubsStore().getPaystubs();
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Attach Paystub to this Pay Period</h3>
    <form
      @submit.prevent="usePayPeriodPaystubsStore().attachPaystubToPayPeriod()"
      class="flex flex-col gap-4"
    >
      <div>
        <FormsInputLabel resource="paystub" text="Select Paystub" />
        <PaystubsPaystubSelection />
      </div>
      <div>
        <FormsInputLabel resource="amount" text="Amount" />
        <FormsInputCurrency
          v-model="usePayPeriodPaystubsStore().form.amount"
          name="amount"
          :disabled="usePayPeriodPaystubsStore().form.isLoading"
        />
      </div>
      <FormsFormErrors
        v-if="usePayPeriodPaystubsStore().form.errors"
        :formErrors="usePayPeriodPaystubsStore().form.errors"
      />
      <ButtonsFormSubmitButton
        buttonText="Save"
        :disabled="usePayPeriodPaystubsStore().form.isLoading"
      />
    </form>
  </div>
</template>
