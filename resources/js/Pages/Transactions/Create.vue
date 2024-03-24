<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TransactionsHeader from '@/Pages/Transactions/Partials/TransactionsHeader.vue';

defineProps({
  bills: Array,
  budgets: Array,
  savings: Array,
});

const form = useForm({
  transactionable_id: '',
  amount: '',
});
</script>

<template>
  <Head title="Transactions" />

  <AuthenticatedLayout>
    <template #header>
      <TransactionsHeader />
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
          <section>
            <header>
              <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                New Transaction
              </h2>

              <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Make a new transaction
              </p>
            </header>

            <form
              @submit.prevent="form.post(route('transactions.store'))"
              class="mt-6 space-y-6"
            >
              <div>
                <InputLabel for="transactionable_id" value="Expense" />

                <select
                  v-model="form.transactionable_id"
                  class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm w-full"
                >
                  <option
                    v-for="(bill, index) in bills"
                    :key="index"
                    :value="bill.id"
                  >
                    {{ bill.bill.issuer }} - {{ bill.bill.name }} (${{
                      bill.remaining_amount / 100
                    }})
                  </option>
                </select>
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

              <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Pay</PrimaryButton>

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
                    Payed.
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
