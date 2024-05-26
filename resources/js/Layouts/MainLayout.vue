<script setup>
import MainNavbar from '@/Layouts/Partials/MainNavbar.vue';
import Footer from '@/Layouts/Partials/Footer.vue';
</script>

<template>
  <div>
    <MainNavbar />

    <main>
      <slot />
      <Footer />
    </main>
  </div>
</template>
