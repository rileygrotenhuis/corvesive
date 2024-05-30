<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';
import PaystubBanner from '@/Pages/Paystubs/Partials/PaystubBanner.vue';
import PaystubToggle from '@/Pages/Paystubs/Partials/PaystubToggle.vue';
import { ref } from 'vue';
import DateFilters from '@/Components/Filters/DateFilters.vue';

const props = defineProps({
  paystubs: Array,
  monthlyPaystubs: Object,
  monthSelectionOptions: Array,
});

const paystubToggle = ref('soon');
const selectedMonth = ref(props.monthSelectionOptions[0]?.value ?? null);
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <div class="max-w-3xl">
        <div class="flex justify-between items-center">
          <PaystubToggle
            :selectedOption="paystubToggle"
            @updateExpenseToggle="paystubToggle = $event"
          />

          <DateFilters
            :selectedMonth="selectedMonth"
            :monthSelectionOptions="monthSelectionOptions"
            @updateSelectedMonth="selectedMonth = $event"
          />

          <a
            v-if="paystubToggle === 'all'"
            :href="route('paystubs.create')"
            class="w-8 h-8 flex text-center justify-center items-center bg-primary-100 p-2 text-primary-1000 font-bold rounded-full hover:bg-primary-700 hover:text-primary-100 transition ease-in-out"
          >
            +
          </a>
          <div v-else class="w-8" />
        </div>

        <div class="py-8">
          <div v-if="paystubToggle === 'all'" class="space-y-6">
            <PaystubBanner
              v-if="paystubs.length > 0"
              v-for="paystub in paystubs"
              :key="paystub.id"
              :paystub="paystub"
            />

            <div v-else>
              <p class="text-primary-100 font-bold">No paystubs found.</p>
            </div>
          </div>

          <div v-else class="space-y-6">
            <PaystubBanner
              v-if="Object.keys(monthlyPaystubs).length > 0"
              v-for="paystub in monthlyPaystubs[selectedMonth]"
              :key="paystub.id"
              :paystub="paystub"
            />

            <div v-else>
              <p class="text-primary-100 font-bold">No paystubs found.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>
