<script setup>
  import { Head, Link, useForm } from '@inertiajs/vue3'
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
  import InputLabel from '@/Components/InputLabel.vue'
  import TextInput from '@/Components/TextInput.vue'
  import InputError from '@/Components/InputError.vue'
  import PrimaryButton from '@/Components/PrimaryButton.vue'
  import PaystubHeader from '@/Pages/Paystubs/Partials/PaystubHeader.vue'

  const props = defineProps({
    paystub: Object
  })

  const form = useForm({
    issuer: props.paystub.issuer,
    amount: props.paystub.amount_in_cents / 100,
    issued_day_of_month: props.paystub.issued_day_of_month,
    notes: props.paystub.notes
  })
</script>

<template>
  <Head title="Paystubs" />

  <AuthenticatedLayout>
    <template #header>
      <PaystubHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                Paystub Settings
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Update the settings for this paystub.
              </p>
            </header>

            <form
              @submit.prevent="form.put(route('paystubs.update', paystub.id))"
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
                <InputLabel
                  for="issued_day_of_month"
                  value="Issued Day of Month"
                />

                <TextInput
                  id="issued_day_of_month"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.issued_day_of_month"
                  required
                />

                <InputError
                  class="mt-2"
                  :message="form.errors.issued_day_of_month"
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
