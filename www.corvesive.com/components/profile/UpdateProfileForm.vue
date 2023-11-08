<script setup>
import useAccountStore from "~/stores/account";
</script>

<template>
  <form
    @submit.prevent="useAccountStore().updateAccount()"
    class="flex flex-col gap-4 max-w-xl"
  >
    <FormsDoubleInput>
      <div>
        <FormsInputLabel resource="first_name" text="First Name" />
        <FormsInputText
          v-model="useAccountStore().form.firstName"
          name="first_name"
          type="text"
          :disabled="useAccountStore().form.isLoading"
        />
      </div>
      <div>
        <FormsInputLabel resource="last_name" text="Last Name" />
        <FormsInputText
          v-model="useAccountStore().form.lastName"
          name="last_name"
          type="text"
          :disabled="useAccountStore().form.isLoading"
        />
      </div>
    </FormsDoubleInput>
    <FormsDoubleInput>
      <div>
        <FormsInputLabel resource="email" text="Email" />
        <FormsInputText
          v-model="useAccountStore().form.email"
          name="email"
          type="text"
          :disabled="useAccountStore().form.isLoading"
        />
      </div>
      <div>
        <FormsInputLabel resource="phone_number" text="Phone Number" />
        <FormsInputText
          v-model="useAccountStore().form.phoneNumber"
          name="phone_number"
          type="text"
          :disabled="useAccountStore().form.isLoading"
        />
      </div>
    </FormsDoubleInput>
    <FormsFormErrors
      v-if="useAccountStore().form.errors"
      :formErrors="useAccountStore().form.errors"
    />
    <ButtonsFormSubmitButton
      buttonText="Save"
      :disabled="useAccountStore().form.isLoading"
    />
  </form>
</template>
