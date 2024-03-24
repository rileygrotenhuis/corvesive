<script setup>
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import TextInput from "@/Components/TextInput.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";

const props = defineProps({
  paystub: Object,
  currentPaystub: Object
});

const form = useForm({
  paystub_id: props.paystub.id,
  amount: props.paystub.amount_in_cents / 100 || '',
});

const removePaystub = () => {
  useForm({}).delete(route('pay-period-paystubs.destroy', props.currentPaystub.id));
};
</script>

<template>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
      <section>
        <header>
          <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ paystub.issuer }}
          </h2>

          <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            Attach this paystub toyour current pay period.
          </p>
        </header>
        <form
          @submit.prevent="form.post(route('pay-period-paystubs.store'))"
          class="mt-6 space-y-6"
        >
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
                @click.prevent="removePaystub"
                v-if="currentPaystub"
                class="bg-red-500"
              >
                Remove
              </DangerButton>
              <PrimaryButton :disabled="form.processing">
                {{ currentPaystub ? 'Update' : 'Attach' }}
              </PrimaryButton>
          </div>
        </form>
      </section>
    </div>
  </div>
</template>
