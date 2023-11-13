<template>
  <nav class="sticky top-0 z-50 py-4 border-b border-gray-800">
    <div
      class="w-11/12 max-w-[1225px] mx-auto flex justify-between items-center"
    >
      <router-link to="/" class="text-2xl font-bold text-rose-500"
        >Corvesive</router-link
      >
      <slot name="profile-menu" />
    </div>
  </nav>
</template>
