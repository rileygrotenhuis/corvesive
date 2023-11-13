<script setup lang="ts">
useHead({
  title: 'Corvesive - Login',
});
</script>

<template>
  <div class="my-8 mx-4">
    <AuthRegistrationAndLoginCard
      title="Login now to"
      subtitle="Corvesive"
      class="mx-auto mt-16"
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
