<script setup>
import { onMounted, ref } from 'vue';
import RescheduleIcon from '@/Components/Icons/RescheduleIcon.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  monthlyExpense: Object,
});

const dropdownOpen = ref(false);
const rescheduleDate = ref(props.monthlyExpense.due_date);

onMounted(() => {
  window.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
      dropdownOpen.value = false;
    }
  });
});

const reschedule = () => {
  useForm({
    due_date: rescheduleDate.value,
  }).put(route('monthly-expenses.reschedule', props.monthlyExpense.id), {
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
            for="due_day_of_month"
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
            class="mt-4 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
          >
            Reschedule
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
