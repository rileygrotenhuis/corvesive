<script setup>
import useAuthStore from '~/stores/auth.js';

const form = useAuthStore().registrationForm;
</script>

<template>
  <form
    @submit.prevent="useAuthStore().register"
    class="w-3/4 lg:w-1/2 max-w-lg p-8 shadow-xl rounded-xl flex flex-col gap-4"
  >
    <FormsDoubleInput>
      <div>
        <FormsInputLabel resource="firstName" text="First Name" />
        <FormsInputText v-model="form.firstName" name="firstName" :disabled="form.isLoading" />
      </div>
      <div>
        <FormsInputLabel resource="lastName" text="Last Name" />
        <FormsInputText v-model="form.lastName" name="lastName" :disabled="form.isLoading" />
      </div>
    </FormsDoubleInput>
    <FormsDoubleInput>
      <div>
        <FormsInputLabel resource="email" text="Email" />
        <FormsInputText v-model="form.email" type="email" name="email" :disabled="form.isLoading" />
      </div>
      <div>
        <FormsInputLabel resource="phoneNumber" text="Phone Number" />
        <FormsInputText v-model="form.phoneNumber" name="phoneNumber" :disabled="form.isLoading" />
      </div>
    </FormsDoubleInput>
    <div>
      <FormsInputLabel resource="password" text="Password" />
      <FormsInputText
        v-model="form.password"
        type="password"
        name="password"
        :disabled="form.isLoading"
      />
    </div>
    <div>
      <FormsInputLabel resource="passwordConfirmation" text="Confirm Password" />
      <FormsInputText
        v-model="form.passwordConfirmation"
        type="password"
        name="passwordConfirmation"
        :disabled="form.isLoading"
      />
    </div>
    <FormsFormErrors v-if="form.errors" :formErrors="form.errors" />
    <ButtonsFormSubmitButton buttonText="Register" :disabled="form.isLoading" />
  </form>
</template>
