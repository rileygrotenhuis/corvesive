<script setup lang="ts">
import type { IRegistrationRequest } from '~/http/requests/auth.request';

const form: IRegistrationRequest = reactive({
  first_name: '',
  last_name: '',
  email: '',
  phone_number: '',
  password: '',
  password_confirmation: '',
});

const errors = ref([]);

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.auth.register(form);

  if (!(errors.value = response.errors)) {
    alert('successful');
    return;
  }
};
</script>

<template>
  <UCard class="max-w-md">
    <h3 class="text-center text-2xl font-bold">Get Started with</h3>
    <h3 class="text-center text-2xl font-bold text-primary">Corvesive</h3>
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
        <UInput v-model="form.password" />
      </UFormGroup>
      <UFormGroup label="Confirm Password" name="password_confirmation">
        <UInput v-model="form.password_confirmation" />
      </UFormGroup>
      <UButton type="submit"> Register </UButton>
      <FormsFormErrors :errors="errors" />
    </UForm>
  </UCard>
</template>
