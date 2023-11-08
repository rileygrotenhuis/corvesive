<script setup>
import useAuthStore from "~/stores/auth";

const form = useAuthStore().loginForm;
</script>

<template>
  <form
    @submit.prevent="useAuthStore().login"
    class="w-3/4 lg:w-1/2 max-w-lg p-8 shadow-xl rounded-xl flex flex-col gap-4"
  >
    <div>
      <FormsInputLabel resource="email" text="Email" />
      <FormsInputText
        v-model="form.email"
        name="email"
        :disabled="form.isLoading"
      />
    </div>
    <div>
      <FormsInputLabel resource="password" text="Password" />
      <FormsInputText
        v-model="form.password"
        type="password"
        name="password"
        :disabled="form.isLoading"
      />
    </div>
    <FormsFormErrors v-if="form.errors" :formErrors="form.errors" />
    <ButtonsFormSubmitButton buttonText="Login" :disabled="form.isLoading" />
  </form>
</template>
