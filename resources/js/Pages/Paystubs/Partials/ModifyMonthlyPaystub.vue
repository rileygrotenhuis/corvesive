<script setup>
import { computed, ref } from 'vue';
import ModifyIcon from '@/Components/Icons/ModifyIcon.vue';
import InputError from '@/Components/Breeze/InputError.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  monthlyPaystub: Object,
});

const showModifyForm = ref(false);

const amountDeposited = computed(() => {
  return (props.monthlyPaystub.amount_deposited / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const amount = computed(() => {
  return (props.monthlyPaystub.amount_in_cents / 100).toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const modifyPaystubForm = useForm({
  amount: props.monthlyPaystub.amount_in_cents / 100,
  amount_in_cents: props.monthlyPaystub.amount_in_cents,
});

const modifyPaystub = () => {
  modifyPaystubForm.amount_in_cents = modifyPaystubForm.amount * 100;

  modifyPaystubForm.put(
    route('monthly-paystubs.update', props.monthlyPaystub.id),
    {
      preserveScroll: true,
      preserveState: true,
      onSuccess: () => {
        showModifyForm.value = false;
      },
    }
  );
};
</script>

<template>
  <div class="mt-4 font-medium text-gray-700">
    <div class="flex items-center gap-2">
      <span class="text-gray-500"> {{ amountDeposited }} of </span>
      <span class="text-primary-700 font-bold text-lg">
        {{ amount }} deposited
      </span>
      <span
        class="cursor-pointer"
        @click.prevent="showModifyForm = !showModifyForm"
      >
        <ModifyIcon />
      </span>
    </div>

    <form
      v-if="showModifyForm"
      @submit.prevent="modifyPaystub"
      class="space-y-6 mt-2"
    >
      <div>
        <label for="amount" class="block text-sm font-medium text-gray-700">
          Modify this monthly paystub.
        </label>
        <input
          v-model="modifyPaystubForm.amount"
          id="amount"
          name="amount"
          type="number"
          step="0.01"
          class="mt-1 block w-full shadow-sm sm:text-sm focus:ring-primary-500 focus:border-primary-500 border-gray-300 rounded-md"
        />
        <InputError :message="modifyPaystubForm.errors.amount_in_cents" />
      </div>

      <div class="flex justify-end">
        <button
          type="submit"
          class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500"
        >
          Save
        </button>
      </div>
    </form>
  </div>
</template>

<style scoped></style>
