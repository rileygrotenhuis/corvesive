<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
</script>

<template>
  <Head title="Pay Period" />

  <AuthenticatedLayout>
    <template #header>
      <div
        class="flex flex-col md:flex-row justify-center sm:justify-between items-center"
      >
        <div
          class="flex flex-col md:flex-row justify-center md:justify-start items-center gap-4 md:gap-16"
        >
          <Link
            :href="route('playground')"
            class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
          >
            Playground
          </Link>
        </div>
      </div>
    </template>

    <div class="py-12">
      <div
        class="max-w-7xl mx-auto flex flex-wrap gap-8 justify-center items-start"
      >
        <h1>Playground</h1>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
