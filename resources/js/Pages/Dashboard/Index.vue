<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
  <Head title="Dashboard" />

  <AuthenticatedLayout>
    <template #header>
      <div
        class="flex flex-col md:flex-row justify-center md:justify-start gap-8 md:gap-16"
      >
        <Link
          :href="route('dashboard')"
          class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
          Dashboard
        </Link>
      </div>
    </template>

    <div
      class="py-12 flex flex-col md:flex-row justify-center items-center gap-12"
    >
      <h1>Dashboard</h1>
    </div>
  </AuthenticatedLayout>
</template>
