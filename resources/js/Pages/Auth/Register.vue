<script setup>
import AuthBannerPane from '@/Pages/Auth/Partials/AuthBannerPane.vue';
import RegisterForm from '@/Pages/Auth/Partials/RegisterForm.vue';
</script>

<template>
  <div class="h-[100vh] flex">
    <AuthBannerPane class="hidden md:inline-flex w-1/2" />

    <RegisterForm class="w-full md:w-1/2 bg-white" />
  </div>
</template>
