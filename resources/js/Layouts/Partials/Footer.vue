<script setup>
import GithubIcon from '@/Components/Icons/GithubIcon.vue';
</script>

<template>
  <footer
    class="max-w-6xl mx-auto px-8 py-60 pb-24 flex justify-center sm:justify-between gap-16 flex-wrap"
  >
    <div>
      <h1 class="text-white text-3xl font-bold">Corvesive.</h1>
      <p class="text-white font-semibold text-sm max-w-[250px]">
        Developed and maintained by
        <span class="text-primary-500">Riley Grotenhuis.</span>
      </p>
    </div>

    <div>
      <div>
        <a
          href="https://www.rileygrotenhuis.com"
          class="text-white font-bold text-lg"
        >
          rileygrotenhuis.com
        </a>
      </div>

      <div class="flex gap-4 justify-end mt-2">
        <a href="https://github.com/rileygrotenhuis/corvesive" target="_blank">
          <GithubIcon />
        </a>
      </div>
    </div>
  </footer>
</template>
