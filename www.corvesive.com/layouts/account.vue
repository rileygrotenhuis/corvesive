<script setup>
import AuthenticatedNavbar from "~/components/navigation/AuthenticatedNavbar.vue";
import PayPeriodHeader from "~/components/navigation/PayPeriodHeader.vue";
import AccountTabs from "~/components/navigation/AccountTabs.vue";
import UtilityWrapper from "~/components/util/UtilityWrapper.vue";
import useAccountStore from "~/stores/account.js";
import Welcome from "~/components/dashboard/Welcome.vue";

useHead({
  htmlAttrs: {
    lang: "en",
  },
});
</script>

<template>
  <div class="mb-16">
    <UtilityWrapper />
    <AuthenticatedNavbar />
    <main>
      <div v-if="useAccountStore().user">
        <Welcome
          v-if="useAccountStore().user.is_onboarding"
          class="w-11/12 max-w-[750px] mx-auto"
        />
        <div v-else class="w-11/12 max-w-[1000px] mx-auto">
          <div class="mt-4 mb-2 font-bold text-gray-700">Account</div>
          <PayPeriodHeader />
          <AccountTabs class="mt-8 mb-8" />
          <slot />
        </div>
      </div>
    </main>
  </div>
</template>
