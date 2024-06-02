<script setup>
import { useForm } from '@inertiajs/vue3';
import PaidIcon from '@/Components/Icons/PaidIcon.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import ReschedulePaystub from '@/Pages/Paystubs/Partials/ReschedulePaystub.vue';
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';
import ModifyMonthlyPaystub from '@/Pages/Paystubs/Partials/ModifyMonthlyPaystub.vue';
import PaystubDeposit from '@/Pages/Paystubs/Partials/PaystubDeposit.vue';
import DepositBanner from '@/Components/Transactions/DepositBanner.vue';
import PaydayTasks from '@/Pages/Paystubs/Partials/PaydayTasks.vue';

const props = defineProps({
  monthlyPaystub: Object,
  paydayTasks: Array,
  upcomingExpenses: Object,
  monthSelectionOptions: Array,
});

const unschedulePaystub = () => {
  if (confirm('Are you sure you want to unschedule this paystub?')) {
    useForm({}).delete(
      route('monthly-paystubs.unschedule', props.monthlyPaystub.id)
    );
  }
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto px-8 my-8">
      <div class="flex flex-col-reverse md:flex-row gap-4 items-start">
        <div class="w-full md:w-2/3 bg-white p-6 rounded-lg">
          <div class="my-2">
            <a
              :href="route('paystubs.index')"
              class="text-primary-700 hover:font-bold"
            >
              &larr; Back to Paystubs
            </a>
          </div>

          <div class="flex justify-between">
            <a :href="route('paystubs.index', monthlyPaystub.paystub.id)">
              <h2
                class="text-2xl font-bold text-primary-700 flex items-center gap-2"
              >
                {{ monthlyPaystub.paystub.issuer }}
                <span v-if="monthlyPaystub.is_deposited">
                  <PaidIcon />
                </span>
              </h2>
            </a>

            <div class="flex items-center gap-4">
              <ReschedulePaystub :monthlyPaystub="monthlyPaystub" />
              <UnscheduleIcon @click.prevent="unschedulePaystub" />
            </div>
          </div>

          <div class="text-black text-sm mt-2">
            {{ monthlyPaystub.paystub.notes }}
          </div>

          <div class="text-black text-sm font-semibold mt-2">
            Deposits on: {{ monthlyPaystub.pay_date }}
          </div>

          <ModifyMonthlyPaystub :monthlyPaystub="monthlyPaystub" />

          <div class="mt-8 text-black">
            <div class="flex justify-between items-center">
              <h4 class="text-lg font-bold text-black">Deposits</h4>

              <PaystubDeposit :monthlyPaystub="monthlyPaystub" />
            </div>

            <div
              v-if="monthlyPaystub.deposits.length > 0"
              class="space-y-2 mt-4"
            >
              <DepositBanner
                v-for="deposit in monthlyPaystub.deposits"
                :key="deposit.id"
                :transaction="deposit"
              />
            </div>
            <div v-else class="text-sm text-gray-500 mt-4">
              No deposits have been made for this paystub.
            </div>
          </div>
        </div>

        <div class="w-full md:w-1/3">
          <PaydayTasks
            :monthlyPaystub="monthlyPaystub"
            :paydayTasks="paydayTasks"
            :upcomingExpenses="upcomingExpenses"
            :monthSelectionOptions="monthSelectionOptions"
          />
        </div>
      </div>
    </div>
  </MainLayout>
</template>
