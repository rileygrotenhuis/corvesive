<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  bills: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <div class="mt-4 flex flex-col gap-4">
      <div class="w-48 mx-auto" v-for="bill in bills.data" :key="bill.id">
        <a :href="route('bills.show', bill.id)">
          <div
            class="text-center border shadow-lg w-48 p-4 rounded-md"
            :class="`${bill.is_payed ? 'bg-green-200' : 'bg-slate-50'}`"
          >
            <h3 class="text-2xl font-semibold">{{ bill.name }}</h3>
            <h4 class="text-xl">${{ (bill.amount / 100).toFixed(2) }}</h4>
          </div>
        </a>
      </div>
      <a class="w-auto mx-auto" :href="route('bills.create')">
        <PrimaryButton>+ Bill</PrimaryButton>
      </a>
    </div>
  </AuthenticatedLayout>
</template>
