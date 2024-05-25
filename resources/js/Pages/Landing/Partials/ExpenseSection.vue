<script setup>
import ExpenseSketch from '@/Components/Sketches/ExpenseSketch.vue';
</script>

<template>
  <div class="w-full bg-primary-400">
    <div
      class="max-w-4xl mx-auto px-8 py-12 md:py-16 flex flex-wrap-reverse items-center justify-center gap-8 md:gap-0"
    >
      <div class="w-full md:w-1/2 flex justify-center">
        <ExpenseSketch />
      </div>

      <div class="w-full md:w-1/2">
        <h3 class="text-primary-950 text-2xl font-bold mb-2">
          Not all expenses look the same...
        </h3>
        <p class="text-primary-950 text-base mb-4">
          Effortlessly monitor every aspect of your monthly spending, whether
          its fixed bills like rent, or fluctuating expenses like groceries runs
          spread across multiple trips.
        </p>
        <a
          href="#"
          class="text-white bg-primary-950 px-4 py-2 rounded-md mt-4 font-semibold hover:bg-primary-700"
        >
          Track Expenses
        </a>
      </div>
    </div>
  </div>
</template>
