<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const form = useForm({
  start_date: '',
  end_date: '',
});
</script>

<template>
  <Head title="Pay Periods" />

  <AuthenticatedLayout>
    <template #header>
      <div
        class="flex flex-col md:flex-row justify-center md:justify-start gap-8 md:gap-16"
      >
        <Link
          :href="route('pay-periods.index')"
          class="font-semibold text-center text-xl text-gray-800 dark:text-gray-200 leading-tight"
        >
          Pay Periods
        </Link>
      </div>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                New Pay Period
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Add a new pay period to keep track of.
              </p>
            </header>

            <form
              @submit.prevent="form.post(route('pay-periods.store'))"
              class="mt-6 space-y-6"
            >
              <div>
                <InputLabel for="start_date" value="Start Date" />

                <TextInput
                  id="start_date"
                  type="date"
                  class="mt-1 block w-full"
                  v-model="form.start_date"
                  required
                  autofocus
                />

                <InputError class="mt-2" :message="form.errors.start_date" />
              </div>

              <div>
                <InputLabel for="end_date" value="End Date" />

                <TextInput
                  id="end_date"
                  type="date"
                  class="mt-1 block w-full"
                  v-model="form.end_date"
                  required
                  autofocus
                />

                <InputError class="mt-2" :message="form.errors.end_date" />
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
