<template>
  <nav class="sticky top-0 z-50 py-4 border-b border-gray-800 shadow-md">
    <div
      class="w-11/12 max-w-[1225px] mx-auto flex justify-between items-center"
    >
      <router-link to="/" class="text-2xl font-bold text-rose-500"
        >Corvesive</router-link
      >
      <div class="hidden md:flex gap-12 text-sm text-secondary">
        <router-link to="/paystubs">Paystubs</router-link>
        <router-link to="/bills">Bills</router-link>
        <router-link to="/budgets">Budgets</router-link>
      </div>
      <div class="flex gap-8">
        <slot name="pay-period-select" />
        <slot name="profile-menu" />
        <slot name="responsive-menu" />
      </div>
    </div>
  </nav>
</template>
