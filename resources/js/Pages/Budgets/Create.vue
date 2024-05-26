<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Checkbox from '@/Components/Checkbox.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
  name: '',
  amount: '',
  show_daily_amount: false,
});
</script>

<template>
  <AuthenticatedLayout>
    <h1 class="text-center text-xl font-semibold">Create Budget</h1>
    <form
      class="mx-auto w-fit"
      @submit.prevent="form.post(route('budgets.store'))"
    >
      <div class="mt-4">
        <InputLabel class="mb-2" value="Name" />
        <TextInput type="text" v-model="form.name" />
      </div>
      <div class="mt-4">
        <InputLabel class="mb-2" value="Amount" />
        <TextInput type="number" step="0.01" v-model="form.amount" />
      </div>
      <div class="mt-4 flex gap-2">
        <Checkbox
          v-model="form.show_daily_amount"
          :checked="form.show_daily_amount"
        />
        <InputLabel class="mb-2" value="Show Daily Amount" />
      </div>
      <PrimaryButton class="mt-4">Save</PrimaryButton>
    </form>
  </AuthenticatedLayout>
</template>
