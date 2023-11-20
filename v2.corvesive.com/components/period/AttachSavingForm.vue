<script setup lang="ts">
import type { IAttachOrUpdatePayPeriodSavingRequest } from '~/http/requests/savings.request';

const savingStore = useSavingStore();
const modalStore = useModalStore();

const form: IAttachOrUpdatePayPeriodSavingRequest = reactive({
  amount: 0,
});

const errors = ref();

const handleSubmit = async () => {
  alert('testing');
};
</script>

<template>
  <div>
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <h4 class="text-xl font-bold text-rose-500">Attach Saving</h4>
      <p class="text-sm font-light">
        Attach on of your Savings to the currently selected Pay Period
      </p>
      <UFormGroup label="Amount" name="amount">
        <UInput v-model="form.amount" />
      </UFormGroup>
      <UButton type="submit" color="rose"> Attach </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
