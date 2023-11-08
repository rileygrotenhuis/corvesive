<script setup>
import usePaystubsStore from "~/stores/paystubs";

const form = usePaystubsStore().form;
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Add new monthly Paystub</h3>
    <form
      @submit.prevent="usePaystubsStore().createPaystub"
      class="flex flex-col gap-4"
    >
      <FormsDoubleInput>
        <div>
          <FormsInputLabel resource="issuer" text="Issuer" />
          <FormsInputText
            v-model="form.issuer"
            name="issuer"
            :disabled="form.isLoading"
          />
        </div>
        <div>
          <FormsInputLabel resource="amount" text="Amount" />
          <FormsInputCurrency
            v-model="form.amount"
            name="amount"
            :disabled="form.isLoading"
          />
        </div>
      </FormsDoubleInput>
      <div>
        <FormsInputLabel resource="notes" text="Notes" />
        <FormsInputTextArea
          v-model="form.notes"
          name="issuer"
          :disabled="form.isLoading"
        />
      </div>
      <FormsFormErrors v-if="form.errors" :formErrors="form.errors" />
      <ButtonsFormSubmitButton buttonText="Save" :disabled="form.isLoading" />
    </form>
  </div>
</template>
