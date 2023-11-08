<script setup>
import useAuthStore from '~/stores/auth';
import useAccountStore from '~/stores/account.js';
</script>

<template>
  <div class="flex-col gap-4 justify-between w-11/12 max-w-[1000px] mx-auto mt-8">
    <NuxtLink
      v-if="useAccountStore().user.pay_period?.id"
      to="/dashboard"
      class="text-slate-200 font-light hover:text-slate-200 hover:shadow-xl"
    >
      Dashboard
    </NuxtLink>
    <NuxtLink to="/monthly" class="text-slate-200 font-light hover:text-slate-200 hover:shadow-xl">
      Monthly
    </NuxtLink>
    <hr class="border-slate-800" />
    <NuxtLink
      to="/account/profile"
      class="text-slate-200 font-light hover:text-slate-200 hover:shadow-xl"
    >
      Profile
    </NuxtLink>
    <button
      class="text-slate-200 text-left font-light hover:text-slate-200 hover:shadow-xl"
      @click.prevent="useAuthStore().logout"
    >
      Logout
    </button>
  </div>
</template>
