<script setup>
import { onMounted, ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import RescheduleIcon from '@/Components/Icons/RescheduleIcon.vue';

const props = defineProps({
  monthlyPaystub: Object,
});

const dropdownOpen = ref(false);
const rescheduleDate = ref(props.monthlyPaystub.pay_day);

onMounted(() => {
  window.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
      dropdownOpen.value = false;
    }
  });
});

const reschedule = () => {
  useForm({
    pay_day: rescheduleDate.value,
  }).put(route('monthly-paystubs.reschedule', props.monthlyPaystub.id), {
    preserveScroll: true,
    preserveState: true,
    onSuccess: () => {
      dropdownOpen.value = false;
    },
  });
};
</script>

<template>
  <div class="relative inline-block text-left cursor-pointer">
    <RescheduleIcon @click="dropdownOpen = !dropdownOpen" />
    <div
      v-if="dropdownOpen"
      class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-primary-100 ring-1 ring-black ring-opacity-5"
    >
      <div class="p-4">
        <div>
          <label
            for="pay_day"
            class="block text-sm font-medium text-primary-700"
          >
            Reschedule Date
          </label>
          <input
            v-model="rescheduleDate"
            id="rescheduleDate"
            name="rescheduleDate"
            type="date"
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
        </div>

        <div>
          <button
            @click="reschedule"
            type="button"
            class="mt-2 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-700 hover:bg-primary-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
          >
            Reschedule
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
