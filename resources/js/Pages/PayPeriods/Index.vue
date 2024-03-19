<script setup>
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PayPeriodsHeader from '@/Pages/PayPeriods/Partials/PayPeriodsHeader.vue';
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <PayPeriodsHeader />
    </template>

    <div class="py-12">
      <h1 class="text-white text-center">
        {{ JSON.stringify($page.props.auth.user.current_pay_period) }}
      </h1>
    </div>
  </AuthenticatedLayout>
</template>
