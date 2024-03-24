<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
  <div
    class="flex flex-col md:flex-row justify-center md:justify-start gap-8 md:gap-16"
  >
    <Link
      :href="route('transactions.create')"
      class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
    >
      Transactions
    </Link>
  </div>
</template>
