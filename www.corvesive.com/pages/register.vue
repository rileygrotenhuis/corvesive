<script setup lang="ts">
useHead({
  htmlAttrs: {
    lang: 'en',
  },
  title: 'Corvesive - Register',
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
      title="Get started with"
      subtitle="Corvesive"
      class="mx-auto"
    >
      <AuthRegistrationForm />
    </AuthRegistrationAndLoginCard>
    <FormsFormFooter
      question="Already have an account?"
      action="Login"
      to="/login"
    />
  </div>
</template>
