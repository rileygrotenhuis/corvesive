<script setup>
import useBudgetsStore from '~/stores/budgets';

const form = useBudgetsStore().form;
</script>

<template>
  <div class="w-11/12 max-w-lg mx-auto">
    <h3 class="text-xl font-bold mb-4">{{ form.name }}</h3>
    <form
      @submit.prevent="useBudgetsStore().updateBudget"
      class="flex flex-col gap-4"
    >
      <FormsDoubleInput>
        <div>
          <FormsInputLabel resource="name" text="Name" />
          <FormsInputText
            v-model="form.name"
            name="name"
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
      <div class="flex gap-4">
        <ButtonsFormDeleteButton
          buttonText="Delete"
          :disabled="form.isLoading"
          @click="useBudgetsStore().deleteBudget"
        />
        <ButtonsFormSubmitButton buttonText="Save" :disabled="form.isLoading" />
      </div>
    </form>
  </div>
</template>
