<script setup>
import { Head, Link } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Table from '@/Components/Tables/Table.vue';
import TableRow from '@/Components/Tables/TableRow.vue';
import TableData from '@/Components/Tables/TableData.vue';
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
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <Table
          title="Table Title"
          description="This is where your table description will go"
          actionHref="playground"
          actionText="Action"
          :columns="['Column 1', 'Column 2', 'Column 3']"
        >
          <TableRow>
            <TableData :value="'Data 1'" />
            <TableData :value="'Data 1'" />
            <TableData :value="'Data 1'" />
          </TableRow>
          <TableRow>
            <TableData :value="'Data 1'" />
            <TableData :value="'Data 1'" />
            <TableData :value="'Data 1'" />
          </TableRow>
        </Table>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
