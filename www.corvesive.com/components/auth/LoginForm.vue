<script setup lang="ts">
import { setAccessToken } from '~/util/auth.util';
import type { ILoginRequest } from '~/http/requests/auth.request';

const accountStore = useAccountStore();
const payPeriodStore = usePayPeriodStore();

const form: ILoginRequest = reactive({
  email: '',
  password: '',
});

const errors = ref();

const handleSubmit = async () => {
  const response = await useNuxtApp().$api.auth.login(form);

  if (!(errors.value = response.errors)) {
    accountStore.setUser(response.user);

    await setAccessToken(response.token);

    await payPeriodStore.getPayPeriods(true);
    await payPeriodStore.getPayPeriod(response.user.pay_period.id);

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
    <UButton type="submit" color="fuchsia"> Login </UButton>
    <FormsFormErrors :errors="errors" />
  </UForm>
</template>
