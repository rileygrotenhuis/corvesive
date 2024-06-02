<script setup>
import { computed, ref } from 'vue';
import InputError from '@/Components/Breeze/InputError.vue';
import { useForm } from '@inertiajs/vue3';
import ModifyIcon from '@/Components/Icons/ModifyIcon.vue';

const props = defineProps({
  task: Object,
});

const emits = defineEmits(['close']);

const showModifyForm = ref(false);

const form = useForm({
  amount: props.task.amount_in_cents / 100,
  amount_in_cents: props.task.amount_in_cents,
});

const submit = () => {
  form.amount_in_cents = form.amount * 100;

  form.put(route('payday-tasks.update', props.task.id), {
    preserveScroll: true,
    onSuccess: () => {
      emits('close');
      form.reset();
    },
  });
};

const removeTask = () => {
  if (confirm('Are you sure you want to remove this task?')) {
    form.delete(route('payday-tasks.destroy', props.task.id), {
      preserveScroll: true,
      onSuccess: () => {
        emits('close');
        form.reset();
      },
    });
  }
};

const completeTask = () => {
  if (
    confirm(
      'Are you sure you want to complete this task? This action will make a payment for the given Expense.'
    )
  ) {
    useForm({}).post(route('payday-tasks.complete', props.task.id), {
      preserveScroll: true,
      onSuccess: () => {
        emits('close');
        form.reset();
      },
    });
  }
};
</script>

<template>
  <form class="p-6 space-y-6" @submit.prevent="submit">
    <div>
      <h3 class="text-lg font-medium leading-6 text-gray-900">
        Pay Day Task - {{ task.monthly_expense.expense.name }}
      </h3>

      <p class="text-gray-700 text-xs md:text-sm max-w-[500px]">
        Some text here... maybe
      </p>
    </div>

    <div class="text-primary-700 font-bold flex items-center gap-1">
      ${{ task.amount }}
      <span class="text-black font-normal">
        <span v-if="!task.is_completed">to be</span>
        paid
      </span>
      <button
        v-if="!task.is_completed"
        @click.prevent="showModifyForm = !showModifyForm"
      >
        <ModifyIcon />
      </button>
    </div>

    <div v-if="showModifyForm">
      <div class="mb-4">
        <label
          for="amount_in_cents"
          class="block text-sm font-medium text-gray-700"
        >
          Amount
        </label>
        <input
          v-model="form.amount"
          id="amount"
          name="amount"
          type="text"
          class="mt-1 text-black w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary-500 focus:border-primary-500 sm:text-sm"
        />
        <InputError :message="form.errors.amount_in_cents" />
      </div>

      <div class="flex justify-center md:justify-end gap-4">
        <button
          class="w-full flex justify-center py-1 px-8 bg-red-500 text-white font-semibold rounded-md hover:bg-red-300 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
          @click.prevent="removeTask"
        >
          Remove
        </button>
        <button
          type="submit"
          class="w-full flex justify-center py-1 px-8 bg-primary-700 text-white font-semibold rounded-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
        >
          Save
        </button>
      </div>
    </div>

    <div v-else-if="task.is_completed">
      <p class="text-primary-700 text-2xl font-bold">Task Completed</p>
    </div>

    <div v-else>
      <button
        @click.prevent="completeTask"
        class="w-full flex justify-center py-1 px-8 bg-primary-700 text-white font-semibold rounded-md hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150"
      >
        Complete
      </button>
    </div>
  </form>
</template>
