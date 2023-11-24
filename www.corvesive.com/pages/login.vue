<script setup lang="ts">
useHead({
  title: 'Corvesive - Login',
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
