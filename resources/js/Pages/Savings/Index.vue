<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  savings: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <div class="mt-4 flex flex-col gap-4">
      <div class="mx-auto w-48" v-for="saving in savings.data" :key="saving.id">
        <a :href="route('savings.show', saving.id)">
          <div
            class="w-48 rounded-md border p-4 text-center shadow-lg"
            :class="`${saving.is_payed ? 'bg-green-200' : 'bg-slate-50'}`"
          >
            <h3 class="text-2xl font-semibold">{{ saving.name }}</h3>
            <h4 class="text-xl">${{ (saving.amount / 100).toFixed(2) }}</h4>
          </div>
        </a>
      </div>
      <a class="mx-auto w-auto" :href="route('savings.create')">
        <PrimaryButton>+ Savings</PrimaryButton>
      </a>
    </div>
  </AuthenticatedLayout>
</template>
