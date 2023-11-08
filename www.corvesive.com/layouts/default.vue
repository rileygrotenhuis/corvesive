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
    <main>
      <slot />
    </main>
  </div>
</template>
