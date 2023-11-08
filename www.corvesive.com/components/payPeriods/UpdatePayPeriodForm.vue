<script setup lang="ts">
import usePayPeriodsStore from '~/stores/payPeriods';

const form = usePayPeriodsStore().form;
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Modify current Pay Period</h3>
    <form
      @submit.prevent="usePayPeriodsStore().updatePayPeriod()"
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
      <div class="flex gap-4">
        <ButtonsFormDeleteButton
          buttonText="Delete"
          :disabled="form.isLoading"
          @click="usePayPeriodsStore().deletePayPeriod"
        />
        <ButtonsFormSubmitButton buttonText="Save" :disabled="form.isLoading" />
      </div>
    </form>
  </div>
</template>
