<script setup lang="ts">
useHead({
  title: 'Corvesive - Register',
});
</script>

<template>
  <div class="my-8 mx-4">
    <AuthRegistrationAndLoginCard
      title="Get started with"
      subtitle="Corvesive"
      class="mx-auto mt-16"
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
