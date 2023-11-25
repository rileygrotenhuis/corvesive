<script setup lang="ts">
import type { IUpdateAccountRequest } from '~/http/requests/account.request';

const accountStore = useAccountStore();

const form: IUpdateAccountRequest = reactive({
  first_name: accountStore.user.names.first,
  last_name: accountStore.user.names.last,
  email: accountStore.user.email,
  phone_number: accountStore.user.phone_number,
  pay_period_id: accountStore.user.pay_period.id,
});

const errors = ref();

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.account.updateAccount(form);

  if (!(errors.value = response.errors)) {
    await accountStore.me();
  }
};
</script>

<template>
  <div class="w-full max-w-xl">
    <UForm :state="form" class="space-y-4" @submit="handleSubmit">
      <UFormGroup label="First Name" name="first_name">
        <UInput v-model="form.first_name" />
      </UFormGroup>
      <UFormGroup label="Last Name" name="last_name">
        <UInput v-model="form.last_name" />
      </UFormGroup>
      <UFormGroup label="Email" name="email">
        <UInput v-model="form.email" />
      </UFormGroup>
      <UFormGroup label="Phone Number" name="phone_number">
        <UInput v-model="form.phone_number" />
      </UFormGroup>
      <UButton type="submit" color="fuchsia"> Save </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </div>
</template>
