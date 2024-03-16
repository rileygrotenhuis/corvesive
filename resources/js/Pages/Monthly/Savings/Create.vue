<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import MonthlyExpenseHeader from '@/Pages/Monthly/Partials/MonthlyExpenseHeader.vue';

const form = useForm({
  name: '',
  amount: '',
  notes: '',
});
</script>

<template>
  <Head title="Savings" />

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
                New Monthly Saving
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Add a new monthly saving to keep track of.
              </p>
            </header>

            <form
              @submit.prevent="form.post(route('savings.store'))"
              class="mt-6 space-y-6"
            >
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
