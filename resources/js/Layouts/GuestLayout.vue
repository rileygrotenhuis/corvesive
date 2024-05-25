<script setup>
import GuestNavbar from '@/Layouts/Partials/GuestNavbar.vue';
import Footer from '@/Layouts/Partials/Footer.vue';
</script>

<template>
  <div>
    <GuestNavbar />

    <main>
      <slot />
      <Footer />
    </main>
  </div>
</template>
