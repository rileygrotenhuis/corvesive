<script setup>
useHead({
  title: 'Corvesive - Login'
});

definePageMeta({
  layout: 'guest'
});
</script>

<template>
  <h3 class="text-3xl font-bold text-center">Welcome Back!</h3>
  <AuthLoginForm />
  <FormsFormFooter
    question="Don't have an account?"
    action="Register here"
    to="/register"
    class="mt-4"
  />
</template>
