<script setup lang="ts">
useHead({
  htmlAttrs: {
    lang: 'en',
  },
  title: 'Corvesive - Login',
  meta: [
    {
      name: 'description',
      content:
        'Corvesivs is a segments budgeting tool built using Laravel and Nuxt.',
    },
  ],
});
</script>

<template>
  <div class="m-8">
    <AuthRegistrationAndLoginCard
      title="Login now to"
      subtitle="Corvesive"
      class="mx-auto"
    >
      <AuthLoginForm />
    </AuthRegistrationAndLoginCard>
    <FormsFormFooter
      question="Don't have an account?"
      action="Register"
      to="/register"
    />
  </div>
</template>
