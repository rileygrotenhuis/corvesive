<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
  title: String,
  description: String,
  actionHref: String,
  actionText: String,
  columns: Array,
  dataLength: Number,
});

const temp = false;
</script>

<template>
  <div class="p-4 sm:p-8 bg-black shadow-sm:rounded-lg">
    <section>
      <header>
        <div class="flex justify-between items-center">
          <div>
            <h2 class="text-lg font-medium text-gray-100">
              {{ title }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
              {{ description }}
            </p>
          </div>
          <Link
            :href="route(actionHref)"
            class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest hover:bg-white focus:bg-white active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 ring-offset-gray-800 transition ease-in-out duration-150"
          >
            {{ actionText }}
          </Link>
        </div>
      </header>

      <table
        v-if="dataLength > 0"
        class="mt-6 min-w-full divide-y divide-gray-700"
      >
        <thead class="bg-zinc-900">
          <tr>
            <th
              scope="col"
              class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider"
              v-for="(column, index) in columns"
              :key="index"
            >
              {{ column }}
            </th>
          </tr>
        </thead>
        <tbody class="bg-black">
          <slot />
        </tbody>
      </table>

      <div v-else class="mt-6 min-w-full divide-y divide-gray-700">
        <h3 class="text-center font-bold text-white text-lg">
          This table is empty!
        </h3>
      </div>
    </section>
  </div>
</template>
