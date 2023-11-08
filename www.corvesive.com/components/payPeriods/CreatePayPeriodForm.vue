<script setup>
import usePayPeriodsStore from '~/stores/payPeriods.js';

const form = usePayPeriodsStore().form;
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Add new custom Pay Period</h3>
    <form
      @submit.prevent="usePayPeriodsStore().createPayPeriod()"
      class="flex flex-col gap-4"
    >
      <FormsDoubleInput>
        <div>
          <FormsInputLabel resource="start_date" text="Start Date" />
          <FormsInputText
            v-model="form.start_date"
            name="start_date"
            type="date"
            :disabled="form.isLoading"
          />
        </div>
        <div>
          <FormsInputLabel resource="end_date" text="End Date" />
          <FormsInputText
            v-model="form.end_date"
            name="end_date"
            type="date"
            :disabled="form.isLoading"
          />
        </div>
      </FormsDoubleInput>
      <FormsFormErrors v-if="form.errors" :formErrors="form.errors" />
      <ButtonsFormSubmitButton buttonText="Save" :disabled="form.isLoading" />
    </form>
  </div>
</template>
