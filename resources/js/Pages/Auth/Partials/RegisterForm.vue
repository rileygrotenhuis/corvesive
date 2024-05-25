<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/Breeze/InputError.vue';

const registerForm = useForm({
  first_name: '',
  last_name: '',
  email: '',
  password: '',
  password_confirmation: '',
});

const submitRegisterForm = () => {
  registerForm.post(route('register.store'));
};
</script>

<template>
  <div class="flex justify-center items-center">
    <div class="w-full max-w-2xl px-8">
      <h4 class="text-black text-3xl font-bold mb-2">Welcome aboard!</h4>
      <p class="text-black mb-2">
        Already have an account?
        <a
          class="text-primary-700 font-bold hover:underline"
          :href="route('login')"
        >
          Sign in!
        </a>
      </p>

      <form class="space-y-6" @submit.prevent="submitRegisterForm">
        <div>
          <label
            for="first_name"
            class="block text-sm font-medium text-gray-700"
          >
            First Name
          </label>
          <input
            v-model="registerForm.first_name"
            id="first_name"
            name="first_name"
            type="text"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="registerForm.errors.first_name" />
        </div>

        <div>
          <label
            for="last_name"
            class="block text-sm font-medium text-gray-700"
          >
            Last Name
          </label>
          <input
            v-model="registerForm.last_name"
            id="last_name"
            name="last_name"
            type="text"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="registerForm.errors.last_name" />
        </div>

        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">
            Email
          </label>
          <input
            v-model="registerForm.email"
            id="email"
            name="email"
            type="email"
            autocomplete="email"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="registerForm.errors.email" />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">
            Password
          </label>
          <input
            v-model="registerForm.password"
            id="password"
            name="password"
            type="password"
            autocomplete="password"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="registerForm.errors.password" />
        </div>

        <div>
          <label
            for="password_confirmation"
            class="block text-sm font-medium text-gray-700"
          >
            Confirm Password
          </label>
          <input
            v-model="registerForm.password_confirmation"
            id="password_confirmation"
            name="password_confirmation"
            type="password"
            autocomplete="password"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="registerForm.errors.password_confirmation" />
        </div>

        <div>
          <button
            type="submit"
            class="w-full flex justify-center py-2 px-4 bg-primary-700 text-white font-semibold rounded-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
          >
            Sign in
          </button>
        </div>
      </form>

      <div
        class="mt-8 text-center text-black hover:text-primary-700 hover:font-semibold transition-all ease-in-out"
      >
        <a :href="route('home')"> Back to home. </a>
      </div>
    </div>
  </div>
</template>
