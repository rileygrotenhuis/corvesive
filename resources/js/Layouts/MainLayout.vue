<script setup>
import MainNavbar from '@/Layouts/Partials/MainNavbar.vue';
import Footer from '@/Layouts/Partials/Footer.vue';
import MainNavbarMobile from '@/Layouts/Partials/MainNavbarMobile.vue';
</script>

<template>
  <div>
    <MainNavbar class="hidden md:block" />
    <MainNavbarMobile class="block md:hidden" />

    <main>
      <slot />
      <Footer />
    </main>
  </div>
</template>
