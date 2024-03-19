<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <div
        class="flex flex-col md:flex-row justify-center md:justify-start gap-8 md:gap-16"
      >
        <Link
          :href="route('pay-periods.index')"
          class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
          Pay Periods
        </Link>
      </div>
    </template>

    <div class="py-12">
      <h1>Content will go here</h1>
    </div>
  </AuthenticatedLayout>
</template>
