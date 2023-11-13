<script setup lang="ts">
import type { ILoginRequest } from '~/http/requests/auth.request';

const form: ILoginRequest = reactive({
  email: '',
  password: '',
});

const errors = ref([]);

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.auth.login(form);

  if (!(errors.value = response.errors)) {
    useAccountStore().setUser(response.user);

    useCookie('corvesive_access_token').value = response.token;

    return await navigateTo('/');
  }
};
</script>

<template>
  <UForm :state="form" class="space-y-4" @submit="handleSubmit">
    <UFormGroup label="Email" name="email">
      <UInput v-model="form.email" />
    </UFormGroup>
    <UFormGroup label="Password" name="password">
      <UInput v-model="form.password" type="password" />
    </UFormGroup>
    <UButton type="submit"> Login </UButton>
    <FormsFormErrors :errors="errors" />
  </UForm>
</template>
