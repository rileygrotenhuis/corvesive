<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import TextInput from '@/Components/TextInput.vue';
import MonthlyExpenseHeader from '@/Pages/Expenses/Partials/MonthlyExpenseHeader.vue';

const props = defineProps({
  monthlyBill: Object,
});

const form = useForm({
  issuer: props.monthlyBill.issuer,
  name: props.monthlyBill.name,
  amount: props.monthlyBill.amount_in_cents / 100,
  due_day_of_month: props.monthlyBill.due_day_of_month,
  notes: props.monthlyBill.notes,
});
</script>

<template>
  <Head title="Bills" />

  <AuthenticatedLayout>
    <template #header>
      <MonthlyExpenseHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Monthly Bill Settings
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update the settings for this monthly bill.
              </p>
            </header>

            <form
              @submit.prevent="form.put(route('bills.update', monthlyBill.id))"
              class="mt-6 space-y-6"
            >
              <div>
                <InputLabel for="issuer" value="Issuer" />

                <TextInput
                  id="issuer"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.issuer"
                  required
                  autofocus
                />

                <InputError class="mt-2" :message="form.errors.issuer" />
              </div>

              <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                  id="name"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.name"
                  required
                />

                <InputError class="mt-2" :message="form.errors.name" />
              </div>

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
                <InputLabel for="due_day_of_month" value="Due Day of Month" />

                <TextInput
                  id="due_day_of_month"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.due_day_of_month"
                  required
                />

                <InputError
                  class="mt-2"
                  :message="form.errors.due_day_of_month"
                />
              </div>

              <div>
                <InputLabel for="notes" value="Notes" />

                <TextInput
                  id="notes"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.notes"
                />

                <InputError class="mt-2" :message="form.errors.notes" />
              </div>

              <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                  enter-active-class="transition ease-in-out"
                  enter-from-class="opacity-0"
                  leave-active-class="transition ease-in-out"
                  leave-to-class="opacity-0"
                >
                  <p
                    v-if="form.recentlySuccessful"
                    class="text-sm text-gray-600 dark:text-gray-400"
                  >
                    Saved.
                  </p>
                </Transition>
              </div>
            </form>
          </section>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
