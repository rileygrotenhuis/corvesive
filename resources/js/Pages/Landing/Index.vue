<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import HeroSection from '@/Pages/Landing/Partials/HeroSection.vue';
import IncomeSection from '@/Pages/Landing/Partials/IncomeSection.vue';
import ExpenseSection from '@/Pages/Landing/Partials/ExpenseSection.vue';
import AboutSection from '@/Pages/Landing/Partials/AboutSection.vue';
</script>

<template>
  <GuestLayout>
    <HeroSection />
    <IncomeSection />
    <ExpenseSection />
    <AboutSection />
  </GuestLayout>
</template>
