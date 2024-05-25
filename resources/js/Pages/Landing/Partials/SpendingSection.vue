<script setup>
import SpendingSketch from '@/Components/Sketches/SpendingSketch.vue';
</script>

<template>
  <section
    class="max-w-6xl py-36 mx-auto px-8 flex flex-col-reverse md:flex-row justify-center items-center gap-8"
  >
    <div class="w-full">
      <h3 class="text-white font-bold text-4xl mb-4">
        Spend the money you <br />
        know you have.
      </h3>
      <p class="text-white text-sm md:text-base mb-2">
        No more estimating. Know exactly how much money you have to spend on the
        things that you want, when you want them.
      </p>
    </div>

    <div class="w-full flex justify-center items-center">
      <SpendingSketch />
    </div>
  </section>
</template>
