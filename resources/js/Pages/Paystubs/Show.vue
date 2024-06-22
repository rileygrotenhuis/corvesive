<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import InputError from '@/Components/Breeze/InputError.vue';
import MainLayout from '@/Layouts/MainLayout.vue';
import SchedulePaystub from '@/Pages/Paystubs/Partials/SchedulePaystub.vue';
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';

const props = defineProps({
  paystub: Object,
});

const recurrenceRateOptions = ref([
  { label: 'Weekly', value: 'weekly' },
  { label: 'Bi-Weekly', value: 'bi-weekly' },
  { label: 'Monthly', value: 'monthly' },
  { label: 'Semi-Monthly', value: 'semi-monthly' },
]);

const dayOfWeekOptions = ref([
  { label: 'Sunday', value: 6 },
  { label: 'Monday', value: 0 },
  { label: 'Tuesday', value: 1 },
  { label: 'Wednesday', value: 2 },
  { label: 'Thursday', value: 3 },
  { label: 'Friday', value: 4 },
  { label: 'Saturday', value: 5 },
]);

const form = useForm({
  issuer: props.paystub.issuer,
  amount: props.paystub.amount_in_cents / 100,
  amount_in_cents: props.paystub.amount_in_cents,
  recurrence_rate: props.paystub.recurrence_rate,
  recurrence_interval_one: props.paystub.recurrence_interval_one,
  recurrence_interval_two: props.paystub.recurrence_interval_two,
  notes: props.paystub.notes,
});

const submitForm = () => {
  if (confirm('Are you sure you want to save this expense?')) {
    form.amount_in_cents = form.amount * 100;
    form.recurrence_interval_one = parseInt(form.recurrence_interval_one);
    form.recurrence_interval_two = parseInt(form.recurrence_interval_two);

    form.put(route('paystubs.update', props.paystub.id));
  }
};

const removePaystub = () => {
  if (confirm('Are you sure you want to remove this paystub?')) {
    form.delete(route('paystubs.destroy', props.paystub.id));
  }
};
</script>

<template>
  <MainLayout>
    <div class="max-w-6xl mx-auto py-6 px-8">
      <form
        @submit.prevent="submitForm"
        class="max-w-3xl space-y-6 bg-white p-6 rounded-lg"
      >
        <a
          :href="route('paystubs.index')"
          class="text-primary-700 hover:font-bold"
        >
          &larr; Back to Paystubs
        </a>

        <div class="flex items-center justify-between">
          <h3 class="text-lg font-semibold text-black">
            Modify your monthly paystub.
          </h3>

          <div class="flex items-center gap-4">
            <SchedulePaystub :paystub="paystub" />
            <UnscheduleIcon @click.prevent="removePaystub" />
          </div>
        </div>

        <div>
          <label for="issuer" class="block text-sm font-medium text-gray-700">
            Issuer
          </label>
          <input
            v-model="form.issuer"
            id="issuer"
            name="issuer"
            type="text"
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="form.errors.issuer" />
        </div>

        <div>
          <label for="amount" class="block text-sm font-medium text-gray-700">
            Amount
          </label>
          <input
            v-model="form.amount"
            id="amount"
            name="amount"
            type="text"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <InputError :message="form.errors.amount" />
        </div>

        <div>
          <label
            for="recurrence_rate"
            class="block text-sm font-medium text-gray-700"
          >
            Recurrence Rate
          </label>
          <select
            v-model="form.recurrence_rate"
            id="recurrence_rate"
            name="recurrence_rate"
            required
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          >
            <option
              v-for="rate in recurrenceRateOptions"
              :key="rate.value"
              :value="rate.value"
            >
              {{ rate.label }}
            </option>
          </select>
        </div>

        <div>
          <label
            for="recurrence_interval_one"
            class="block text-sm font-medium text-gray-700"
          >
            Every month on the
          </label>
          <input
            v-if="
              form.recurrence_rate === 'monthly' ||
              form.recurrence_rate === 'semi-monthly'
            "
            v-model="form.recurrence_interval_one"
            id="recurrence_interval_one"
            name="recurrence_interval_one"
            type="number"
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
          <select
            v-else
            v-model="form.recurrence_interval_one"
            id="recurrence_interval_one"
            name="recurrence_interval_one"
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          >
            <option
              v-for="day in dayOfWeekOptions"
              :key="day.value"
              :value="day.value"
            >
              {{ day.label }}
            </option>
          </select>
        </div>

        <div v-if="form.recurrence_rate === 'semi-monthly'">
          <label
            for="recurrence_interval_two"
            class="block text-sm font-medium text-gray-700"
          >
            And the
          </label>
          <input
            v-model="form.recurrence_interval_two"
            id="recurrence_interval_two"
            name="recurrence_interval_two"
            type="number"
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
          />
        </div>

        <div>
          <label for="notes" class="block text-sm font-medium text-gray-700">
            Notes
          </label>
          <textarea
            v-model="form.notes"
            id="notes"
            name="notes"
            class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
            rows="4"
          />
          <InputError :message="form.errors.notes" />
        </div>

        <div class="flex justify-end">
          <button
            type="submit"
            class="w-full md:w-fit flex justify-center py-1 px-8 bg-primary-700 text-white font-semibold rounded-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
          >
            Save
          </button>
        </div>
      </form>
    </div>
  </MainLayout>
</template>
