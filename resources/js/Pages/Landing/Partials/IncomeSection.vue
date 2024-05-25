<script setup>
import IncomeSketch from '@/Components/Sketches/IncomeSketch.vue';
</script>

<template>
  <div class="w-full bg-white">
    <div
      class="max-w-4xl mx-auto px-8 py-12 md:py-16 flex flex-wrap-reverse items-center justify-center gap-8 md:gap-0"
    >
      <div class="w-full md:w-1/2">
        <h3 class="text-primary-950 text-2xl font-bold mb-2">
          Your paychecks, when <br />
          you get them.
        </h3>
        <p class="text-primary-950 text-base mb-4">
          Customize how you visualize your income by defining all of your
          monthly paychecks.
        </p>
        <a
          href="#"
          class="text-white bg-primary-700 px-4 py-2 rounded-md mt-4 font-semibold hover:bg-primary-950"
        >
          Track Paychecks
        </a>
      </div>

      <div class="w-full md:w-1/2 flex justify-center">
        <IncomeSketch />
      </div>
    </div>
  </div>
</template>
