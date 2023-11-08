<script setup lang="ts">
useHead({
  title: 'Corvesive',
});
</script>

<template>
  <div class="w-5/6 md:w-4/6 mx-auto mt-8 md:mt-24 max-w-[1100px]">
    <span>Budgeting with</span>
    <h1 class="text-5xl md:text-6xl font-bold mt-4">Corvesive</h1>
    <h2 class="text-5xl text-blue-700 md:text-6xl font-bold mt-4">
      Segmeneted Budgeting Tool
    </h2>
    <p class="font-light w-5/6 md:w-4/6 mt-8">
      Corvesive is a budgeting application that focuses on reporting and
      tracking your personal finances over the course of customizable segments
      of times.
    </p>
    <div class="py-2 px-4 w-fit bg-black text-white rounded-xl shadow-2xl mt-4">
      <NuxtLink to="/login">Get Started Now!</NuxtLink>
    </div>
  </div>
</template>
