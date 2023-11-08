<script setup>
import useBillsStore from '~/stores/bills';

const form = useBillsStore().form;
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">Add new monthly Bill</h3>
    <form @submit.prevent="useBillsStore().createBill" class="flex flex-col gap-4">
      <FormsDoubleInput>
        <div>
          <FormsInputLabel resource="issuer" text="Issuer" />
          <FormsInputText v-model="form.issuer" name="issuer" :disabled="form.isLoading" />
        </div>
        <div>
          <FormsInputLabel resource="name" text="Name" />
          <FormsInputText v-model="form.name" name="name" :disabled="form.isLoading" />
        </div>
      </FormsDoubleInput>
      <FormsDoubleInput>
        <div>
          <FormsInputLabel resource="amount" text="Amount" />
          <FormsInputCurrency v-model="form.amount" name="amount" :disabled="form.isLoading" />
        </div>
        <div>
          <FormsInputLabel resource="due_date" text="Day of Month" />
          <FormsInputText
            v-model="form.due_date"
            type="number"
            name="due_date"
            :disabled="form.isLoading"
          />
        </div>
      </FormsDoubleInput>
      <div>
        <FormsInputLabel resource="notes" text="Notes" />
        <FormsInputTextArea v-model="form.notes" name="issuer" :disabled="form.isLoading" />
      </div>
      <FormsFormErrors v-if="form.errors" :formErrors="form.errors" />
      <ButtonsFormSubmitButton buttonText="Save" :disabled="form.isLoading" />
    </form>
  </div>
</template>
