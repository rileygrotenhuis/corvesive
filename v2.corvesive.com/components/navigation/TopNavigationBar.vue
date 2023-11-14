<template>
  <nav class="sticky top-0 z-50 py-4 border-b border-gray-800 shadow-md">
    <div
      class="w-11/12 max-w-[850px] mx-auto flex justify-between items-center"
    >
      <router-link
        to="/"
        :class="
          $route.path === '/'
            ? 'text-rose-500 text-2xl font-bold'
            : 'text-white text-2xl font-bold'
        "
        >Corvesive</router-link
      >
      <div class="hidden md:flex gap-12 text-sm text-secondary">
        <router-link
          :class="$route.path.includes('/paystubs') ? 'text-rose-500' : ''"
          to="/paystubs"
          >Paystubs</router-link
        >
        <router-link
          :class="$route.path.includes('/bills') ? 'text-rose-500' : ''"
          to="/bills"
          >Bills</router-link
        >
        <router-link
          :class="$route.path.includes('/budgets') ? 'text-rose-500' : ''"
          to="/budgets"
          >Budgets</router-link
        >
      </div>
      <div class="flex gap-8">
        <slot name="pay-period-select" />
        <slot name="profile-menu" />
        <slot name="responsive-menu" />
      </div>
    </div>
  </nav>
</template>
