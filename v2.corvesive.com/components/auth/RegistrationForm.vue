<script setup lang="ts">
import { setAccessToken } from '~/util/auth.util';
import type { IRegistrationRequest } from '~/http/requests/auth.request';

const form: IRegistrationRequest = reactive({
  first_name: '',
  last_name: '',
  email: '',
  phone_number: '',
  password: '',
  password_confirmation: '',
});

const errors = ref();

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.auth.register(form);

  if (!(errors.value = response.errors)) {
    useAccountStore().setUser(response.user);

    await setAccessToken(response.token);

    await usePayPeriodStore().getPayPeriods();
    await usePayPeriodStore().getPayPeriod(response.user.pay_period.id);

    return await navigateTo('/');
  }
};
</script>

<template>
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
    <UFormGroup label="Password" name="password">
      <UInput v-model="form.password" type="password" />
    </UFormGroup>
    <UFormGroup label="Confirm Password" name="password_confirmation">
      <UInput v-model="form.password_confirmation" type="password" />
    </UFormGroup>
    <UButton type="submit" color="rose"> Register </UButton>
    <FormsFormErrors :errors="errors" />
  </UForm>
</template>
