<script setup lang="ts">
useHead({
  title: 'Corvesive - Register',
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
