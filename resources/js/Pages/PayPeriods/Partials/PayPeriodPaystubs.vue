<script setup>
defineProps({
  paystubs: Array,
});
</script>

<template>
  <section>
    <header>
      <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        Manage Paystubs
      </h2>

      <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        View and manage your paystubs during this pay period.
      </p>
    </header>

    <ul class="mt-4 list-disc">
      <li
        v-for="(paystub, index) in paystubs"
        :key="index"
        class="text-white list-disc ml-8"
      >
        {{ paystub.issuer }} - ${{ paystub.pivot.amount_in_cents / 100 }}
      </li>
    </ul>
  </section>
</template>
