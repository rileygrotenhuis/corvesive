<script setup>
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/Breeze/InputError.vue';

const loginForm = useForm({
  email: '',
  password: '',
});

const submitLoginForm = () => {
  loginForm.post(route('login.store'));
};
</script>

<template>
  <div class="flex justify-center items-center">
    <div class="w-full max-w-2xl px-8">
      <h4 class="text-black text-3xl font-bold mb-2">Welcome back!</h4>
      <p class="text-black mb-8">
        Don't have an account?
        <a
          class="text-primary-700 font-bold hover:underline"
          :href="route('register')"
        >
          Register now!
        </a>
      </p>

      <form class="space-y-6" @submit.prevent="submitLoginForm">
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">
            Email
          </label>
          <input
            v-model="loginForm.email"
            id="email"
            name="email"
            type="email"
            autocomplete="email"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="loginForm.errors.email" />
        </div>

        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">
            Password
          </label>
          <input
            v-model="loginForm.password"
            id="password"
            name="password"
            type="password"
            autocomplete="password"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="loginForm.errors.password" />
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
