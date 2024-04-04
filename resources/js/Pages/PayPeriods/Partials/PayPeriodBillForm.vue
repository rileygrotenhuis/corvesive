<script setup>
import { useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';

const props = defineProps({
  bill: Object,
  currentBill: Object,
});

const form = useForm({
  bill_id: props.bill.id,
  amount: props.currentBill
    ? props.currentBill.pivot.amount_in_cents / 100
    : props.bill.remaining_amount / 100 || '',
  due_date: props.currentBill ? props.currentBill.pivot.due_date : '',
});

const addBill = () => {
  form.post(route('pay-period-bills.store'), {
    preserveScroll: true,
  });
};

const removeBill = () => {
  useForm({}).delete(
    route('pay-period-bills.destroy', props.currentBill.pivot.id),
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
            {{ bill.issuer }} - {{ bill.name }}
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Attach this bill to your current pay period.
          </p>
        </header>
        <form @submit.prevent="addBill" class="mt-6 space-y-6">
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
          <div>
            <InputLabel for="due_date" value="Due Date" />

            <TextInput
              id="due_date"
              type="date"
              class="mt-1 block w-full"
              v-model="form.due_date"
              required
            />

            <InputError class="mt-2" :message="form.errors.due_date" />
          </div>
          <div class="flex items-center gap-4">
            <DangerButton
              @click.prevent="removeBill"
              v-if="currentBill"
              class="bg-red-500"
            >
              Remove
            </DangerButton>
            <PrimaryButton :disabled="form.processing">
              {{ currentBill ? 'Update' : 'Attach' }}
            </PrimaryButton>
          </div>
        </form>
      </section>
    </div>
  </div>
</template>
