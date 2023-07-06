<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineProps({
  budgets: Array,
});
</script>

<template>
  <AuthenticatedLayout>
    <div class="mt-4 flex flex-col gap-4">
      <div class="mx-auto w-48" v-for="budget in budgets.data" :key="budget.id">
        <a :href="route('budgets.show', budget.id)">
          <div
            class="w-48 rounded-md border bg-slate-50 p-4 text-center shadow-lg"
          >
            <h3 class="text-2xl font-semibold">{{ budget.name }}</h3>
            <h4 class="text-xl">${{ (budget.amount / 100).toFixed(2) }}</h4>
            <h4 v-if="budget.show_daily_amount">
              (~${{ (budget.average_daily_amount / 100).toFixed(2) }}/day)
            </h4>
          </div>
        </a>
      </div>
      <a class="mx-auto w-auto" :href="route('budgets.create')">
        <PrimaryButton>+ Budget</PrimaryButton>
      </a>
    </div>
  </AuthenticatedLayout>
</template>
