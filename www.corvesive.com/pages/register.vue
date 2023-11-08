<script setup>
useHead({
  title: 'Corvesive - Register'
});

definePageMeta({
  layout: 'guest'
});
</script>

<template>
  <h3 class="text-3xl font-bold text-center">Get started!</h3>
  <AuthRegistrationForm />
  <FormsFormFooter
    question="Already have an account?"
    action="Login here"
    to="/login"
    class="mt-4"
  />
</template>
