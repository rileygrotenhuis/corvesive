<script setup>
import usePayPeriodDashboardStore from "~/stores/payPeriodDashboard.js";
import DashboardIcon from "~/components/icons/DashboardIcon.vue";
import copy from "~/libs/locales/copy.js";
import usePayPeriodsStore from "~/stores/payPeriods.js";

useHead({
  title: "Corvesive - Pay Period Dashboard",
});

definePageMeta({
  layout: "dashboard",
});

await usePayPeriodDashboardStore().getPayPeriodDashboardMetrics();
</script>

<template>
  <div>
    <NavigationPageHeader
      :icon="DashboardIcon"
      title="Dashboard"
      :subtext="copy['payPeriod']['dashboard']"
    />
    <MetricsDashboardMetrics
      v-if="!usePayPeriodsStore().currentPayPeriod?.is_complete"
      class="mt-4"
    />
    <div v-else class="font-bold text-xl">
      This Pay Period has been marked as complete!
    </div>
  </div>
</template>
