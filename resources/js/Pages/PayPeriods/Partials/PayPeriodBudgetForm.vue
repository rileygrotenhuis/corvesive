<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
  budget: Object,
  currentBudget: Object,
});

const form = useForm({
  budget_id: props.budget.id,
  total_balance: props.currentBudget
    ? props.currentBudget.pivot.total_balance_in_cents / 100
    : props.budget.total_balance_in_cents / 100 || '',
});

const removeBudget = () => {
  useForm({}).delete(
    route('pay-period-budgets.destroy', props.currentBudget.pivot.id)
  );
};
</script>

<template>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <section>
        <header>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ budget.name }}
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Attach this budget to your current pay period.
          </p>
        </header>
        <form
          @submit.prevent="form.post(route('pay-period-budgets.store'))"
          class="mt-6 space-y-6"
        >
          <div>
            <InputLabel for="total_balance" value="Total Balance" />
            <TextInput
              id="total_balance"
              type="text"
              class="mt-1 block w-full"
              v-model="form.total_balance"
              pattern="[0-9]+(\.[0-9]{1,2})?"
              required
            />

            <InputError class="mt-2" :message="form.errors.total_balance" />
          </div>
          <div class="flex items-center gap-4">
            <DangerButton
              @click.prevent="removeBudget"
              v-if="currentBudget"
              class="bg-red-500"
            >
              Remove
            </DangerButton>
            <PrimaryButton :disabled="form.processing">
              {{ currentBudget ? 'Update' : 'Attach' }}
            </PrimaryButton>
          </div>
        </form>
      </section>
    </div>
  </div>
</template>
