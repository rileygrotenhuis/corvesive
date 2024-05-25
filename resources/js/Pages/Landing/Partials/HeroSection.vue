<script setup>
import HeroSketch from '@/Components/Sketches/HeroSketch.vue';
</script>

<template>
  <section
    class="max-w-6xl h-[100vh] md:h-[65vh] mx-auto px-8 flex justify-center mt-32 md:mt-48 gap-24"
  >
    <div class="w-full mt-8">
      <h1 class="text-4xl font-bold mb-4">
        Budgeting never <br />
        needed to be so complex.
      </h1>
      <p class="mb-4">
        Record your personal finances and view your money in the way that you
        want to see it.
      </p>
      <a
        :href="route('register')"
        class="bg-primary-600 text-white px-4 py-1 rounded-md font-semibold hover:bg-primary-700 transition-all"
      >
        Get Started
      </a>
    </div>

    <div class="hidden md:block w-full">
      <HeroSketch />
    </div>
  </section>
</template>
