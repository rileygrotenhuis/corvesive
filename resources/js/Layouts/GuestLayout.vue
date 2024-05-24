<script setup>
import Navbar from '@/Layouts/Partials/Navbar.vue';
import Footer from '@/Layouts/Partials/Footer.vue';
</script>

<template>
  <div>
    <Navbar />

    <main>
      <slot />
      <Footer />
    </main>
  </div>
</template>
