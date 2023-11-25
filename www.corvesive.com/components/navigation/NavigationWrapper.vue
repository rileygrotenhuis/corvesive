<template>
  <nav
    class="sticky top-0 z-50 py-4 border-b border-gray-800 bg-gray-900 shadow-md"
  >
    <div
      class="w-11/12 max-w-[850px] mx-auto flex justify-between items-center"
    >
      <router-link
        to="/"
        :class="
          $route.path === '/'
            ? 'text-fuchsia-500 text-2xl font-bold'
            : 'text-white text-2xl font-bold'
        "
        >Corvesive</router-link
      >
      <div class="hidden md:flex gap-12 text-sm text-secondary">
        <router-link
          :class="`${
            $route.path.includes('/income') ? 'text-fuchsia-500' : ''
          } hover:text-fuchsia-500`"
          to="/income"
          >Income</router-link
        >
        <router-link
          :class="`${
            $route.path.includes('/expenses') ? 'text-fuchsia-500' : ''
          } hover:text-fuchsia-500`"
          to="/expenses"
          >Expenses</router-link
        >
        <router-link
          :class="`${
            $route.path.includes('/savings') ? 'text-fuchsia-500' : ''
          } hover:text-fuchsia-500`"
          to="/savings"
          >Savings</router-link
        >
      </div>
      <div class="flex gap-6">
        <slot name="create-menu" />
        <slot name="transaction-menu" />
        <slot name="pay-period-popover" />
        <slot name="profile-menu" />
      </div>
    </div>
    <div
      class="flex md:hidden gap-20 text-sm text-secondary justify-center mt-8"
    >
      <router-link
        :class="`${
          $route.path.includes('/income') ? 'text-fuchsia-500' : ''
        } hover:text-fuchsia-500`"
        to="/income"
        >Income</router-link
      >
      <router-link
        :class="`${
          $route.path.includes('/expenses') ? 'text-fuchsia-500' : ''
        } hover:text-fuchsia-500`"
        to="/expenses"
        >Expenses</router-link
      >
      <router-link
        :class="`${
          $route.path.includes('/savings') ? 'text-fuchsia-500' : ''
        } hover:text-fuchsia-500`"
        to="/savings"
        >Savings</router-link
      >
    </div>
  </nav>
</template>
