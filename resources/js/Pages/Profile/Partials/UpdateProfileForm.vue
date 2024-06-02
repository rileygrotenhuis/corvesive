<script setup>
import InputError from '@/Components/Breeze/InputError.vue';
import { useForm, usePage } from '@inertiajs/vue3';

const user = usePage().props.auth.user;

const profileForm = useForm({
  first_name: user.first_name,
  last_name: user.last_name,
  email: user.email,
});

const submitForm = () => {
  profileForm.put(route('profile.update'));
};
</script>

<template>
  <form
    @submit.prevent="submitForm"
    class="max-w-3xl space-y-6 bg-white p-6 rounded-lg"
  >
    <h3 class="text-lg font-semibold text-black">
      Manage your profile information.
    </h3>

    <div>
      <label for="first_name" class="block text-sm font-medium text-gray-700">
        First Name
      </label>
      <input
        v-model="profileForm.first_name"
        type="text"
        name="first_name"
        id="first_name"
        class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
      />
      <InputError :message="profileForm.errors.first_name" />
    </div>

    <div>
      <label for="last_name" class="block text-sm font-medium text-gray-700">
        Last Name
      </label>
      <input
        v-model="profileForm.last_name"
        type="text"
        name="last_name"
        id="last_name"
        class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
      />
      <InputError :message="profileForm.errors.last_name" />
    </div>

    <div>
      <label for="email" class="block text-sm font-medium text-gray-700">
        Email Address
      </label>
      <input
        v-model="profileForm.email"
        type="email"
        name="email"
        id="email"
        class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
      />
      <InputError :message="profileForm.errors.email" />
    </div>

    <div class="flex justify-end">
      <button
        type="submit"
        class="w-full md:w-fit flex justify-center py-1 px-8 bg-primary-700 text-white font-semibold rounded-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
      >
        Save
      </button>
    </div>
  </form>
</template>
