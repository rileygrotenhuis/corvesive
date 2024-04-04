<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
  saving: Object,
  currentSaving: Object,
});

const form = useForm({
  saving_id: props.saving.id,
  amount: props.currentSaving
    ? props.currentSaving.pivot.amount_in_cents / 100
    : props.saving.remaining_amount / 100 || '',
});

const addSaving = () => {
  form.post(route('pay-period-savings.store'), {
    preserveScroll: true,
  });
};

const removeSaving = () => {
  useForm({}).delete(
    route('pay-period-savings.destroy', props.currentSaving.pivot.id),
    {
      preserveScroll: true,
    }
  );
};
</script>

<template>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-black shadow sm:rounded-lg">
      <section>
        <header>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ saving.name }}
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Attach this saving to your current pay period.
          </p>
        </header>
        <form @submit.prevent="addSaving" class="mt-6 space-y-6">
          <div>
            <InputLabel for="amount" value="Amount" />
            <TextInput
              id="amount"
              type="text"
              class="mt-1 block w-full"
              v-model="form.amount"
              pattern="[0-9]+(\.[0-9]{1,2})?"
              required
            />

            <InputError class="mt-2" :message="form.errors.amount" />
          </div>
          <div class="flex items-center gap-4">
            <DangerButton
              @click.prevent="removeSaving"
              v-if="currentSaving"
              class="bg-red-500"
            >
              Remove
            </DangerButton>
            <PrimaryButton :disabled="form.processing">
              {{ currentSaving ? 'Update' : 'Attach' }}
            </PrimaryButton>
          </div>
        </form>
      </section>
    </div>
  </div>
</template>
