<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import DateFilters from '@/Components/Filters/DateFilters.vue';
import { computed, ref } from 'vue';
import PaystubBanner from '@/Pages/Paystubs/Partials/PaystubBanner.vue';

const props = defineProps({
  paystubs: Object,
});

const selectedDateRange = ref('all');

const selectedPaystubs = computed(() => {
  return props.paystubs[selectedDateRange.value];
});

const noPaystubsFoundMessage = computed(() => {
  const snippet =
    selectedDateRange.value === 'all' ? '' : selectedDateRange.value;

  return `No paystubs ${snippet} found.`;
});
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <div class="max-w-3xl">
        <div class="flex justify-between items-center">
          <DateFilters
            :selectedDateRange="selectedDateRange"
            @updateSelectedDateFilter="selectedDateRange = $event"
          />

          <a
            :href="route('paystubs.create')"
            class="w-8 h-8 flex text-center justify-center items-center bg-primary-100 p-2 text-primary-1000 font-bold rounded-full hover:bg-primary-700 hover:text-primary-100 transition ease-in-out"
          >
            +
          </a>
        </div>

        <div class="space-y-6 py-8">
          <PaystubBanner
            v-if="selectedPaystubs.length > 0"
            v-for="paystub in selectedPaystubs"
            :key="paystub.id"
            :paystub="paystub"
          />

          <div v-else>
            <p class="text-primary-100 font-bold">
              {{ noPaystubsFoundMessage }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
