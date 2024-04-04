<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import NavLink from '@/Components/NavLink.vue';
import { ref } from 'vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';

const showingNavigationDropdown = ref(false);

const userHasPayPeriod = Boolean(usePage().props.auth.user.current_pay_period);

const navigationLinks = [
  {
    href: userHasPayPeriod ? 'pay-periods.index' : 'pay-periods.create',
    label: 'Pay Periods',
  },
  {
    href: 'income.index',
    label: 'Income',
  },
  {
    href: 'expenses.index',
    label: 'Expenses',
  },
];
</script>

<template>
  <div class="bg-zinc-900 text-white">
    <div class="min-h-screen">
      <nav class="bg-black border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex justify-between h-16">
            <div class="flex">
              <div class="shrink-0 flex items-center">
                <Link :href="route('pay-periods.index')">
                  <ApplicationLogo
                    class="block h-9 w-auto fill-current text-gray-200"
                  />
                </Link>
              </div>

              <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink
                  v-for="(nav, index) in navigationLinks"
                  :key="index"
                  :href="route(nav.href)"
                  :active="route().current(nav.href)"
                >
                  {{ nav.label }}
                </NavLink>
              </div>
            </div>

            <div class="flex items-center gap-4">
              <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                <NavLink
                  v-if="userHasPayPeriod"
                  :href="route('transactions.create')"
                  :active="route().current('transactions.create')"
                >
                  + Transaction
                </NavLink>
              </div>

              <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                  <Dropdown align="right" width="48">
                    <template #trigger>
                      <span class="inline-flex rounded-md">
                        <button
                          type="button"
                          class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white focus:outline-none transition ease-in-out duration-150"
                        >
                          {{ $page.props.auth.user.name }}
                          <svg
                            class="ms-2 -me-0.5 h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                            fill="currentColor"
                          >
                            <path
                              fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd"
                            />
                          </svg>
                        </button>
                      </span>
                    </template>

                    <template #content>
                      <DropdownLink :href="route('profile.edit')">
                        Profile
                      </DropdownLink>
                      <DropdownLink
                        :href="route('logout')"
                        method="post"
                        as="button"
                      >
                        Log Out
                      </DropdownLink>
                    </template>
                  </Dropdown>
                </div>
              </div>
            </div>

            <div class="-me-2 flex items-center sm:hidden">
              <button
                @click="showingNavigationDropdown = !showingNavigationDropdown"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-500 transition duration-150 ease-in-out"
              >
                <svg
                  class="h-6 w-6"
                  stroke="currentColor"
                  fill="none"
                  viewBox="0 0 24 24"
                >
                  <path
                    :class="{
                      hidden: showingNavigationDropdown,
                      'inline-flex': !showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                  />
                  <path
                    :class="{
                      hidden: !showingNavigationDropdown,
                      'inline-flex': showingNavigationDropdown,
                    }"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                  />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div
          :class="{
            block: showingNavigationDropdown,
            hidden: !showingNavigationDropdown,
          }"
          class="sm:hidden"
        >
          <div class="pt-2 pb-3 space-y-1">
            <ResponsiveNavLink
              v-for="(nav, index) in navigationLinks"
              :key="index"
              :href="route(nav.href)"
              :active="route().current(nav.href)"
            >
              {{ nav.label }}
            </ResponsiveNavLink>
          </div>

          <div class="pt-4 pb-1 border-t border-gray-600">
            <div class="px-4">
              <div class="font-medium text-base text-gray-200">
                {{ $page.props.auth.user.name }}
              </div>
              <div class="font-medium text-gray-500">
                {{ $page.props.auth.user.email }}
              </div>
            </div>

            <div class="mt-3 space-y-1">
              <ResponsiveNavLink :href="route('profile.edit')">
                Profile
              </ResponsiveNavLink>
              <ResponsiveNavLink
                :href="route('logout')"
                method="post"
                as="button"
              >
                Log Out
              </ResponsiveNavLink>
            </div>
          </div>
        </div>
      </nav>

      <header class="bg-black shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <slot name="header" />
        </div>
      </header>

      <main>
        <slot />
      </main>
    </div>
  </div>
</template>

<style scoped>
.main-container {
  background-color: white !important;
}
</style>
