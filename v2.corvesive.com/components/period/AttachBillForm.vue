<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodBillRequest } from '~/http/requests/bills.request';

const billStore = useBillStore();
const modalStore = useModalStore();

const form: IAttachOrUpdatePayPeriodBillRequest = reactive({
  amount: 0,
  due_date: '',
  is_automatic: false,
});

const errors = ref();

const handleSubmit = async () => {
  alert('testing');
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">Attach Bill</h4>
      <p class="text-sm font-light">
        Attach on of your Bills to the currently selected Pay Period
      </p>
      <UFormGroup label="Due Date" name="due_date">
        <UInput v-model="form.due_date" type="date" />
      </UFormGroup>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UFormGroup label="Is this bill automatic?" name="is_automatic">
        <UCheckbox :v-model="Boolean(form.is_automatic)" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Attach </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
