<script setup>
import GuestNavbar from "~/components/navigation/GuestNavbar.vue";
import UtilityWrapper from "~/components/util/UtilityWrapper.vue";

useHead({
  htmlAttrs: {
    lang: "en",
  },
});
</script>

<template>
  <div>
    <UtilityWrapper />
    <GuestNavbar />
    <main class="flex flex-col items-center justify-center mt-16 md:mt-32">
      <slot />
    </main>
  </div>
</template>
