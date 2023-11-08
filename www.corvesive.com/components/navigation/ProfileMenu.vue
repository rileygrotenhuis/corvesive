<script setup>
import useAuthStore from "~/stores/auth";
import { ref, onMounted, onBeforeUnmount } from "vue";

const isNavigationMenuOpen = ref(false);

onMounted(() => {
  document.addEventListener("click", closeMenuOnClickOutside);
});

onBeforeUnmount(() => {
  document.removeEventListener("click", closeMenuOnClickOutside);
});

const closeMenuOnClickOutside = (event) => {
  if (
    isNavigationMenuOpen.value &&
    !document.querySelector("#profile-dropdown").contains(event.target)
  ) {
    isNavigationMenuOpen.value = false;
  }
};
</script>

<template>
  <div id="profile-dropdown" class="hidden md:relative md:inline-block">
    <IconsProfileIcon
      @click.prevent="isNavigationMenuOpen = !isNavigationMenuOpen"
      class="hover:cursor-pointer"
    />
    <div
      v-if="isNavigationMenuOpen"
      @click.prevent="isNavigationMenuOpen = false"
      class="origin-top-right absolute right-0 mt-2 w-32 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
    >
      <div class="py-2 flex flex-col p-2">
        <NuxtLink
          to="/account/profile"
          class="font-light text-sm px-1 py-2 rounded-md hover:bg-slate-200 hover:cursor-pointer"
        >
          Profile
        </NuxtLink>
        <button
          class="text-left font-light text-sm px-1 py-2 rounded-md hover:bg-slate-200"
          @click.prevent="useAuthStore().logout"
        >
          Logout
        </button>
      </div>
    </div>
  </div>
</template>
