<script setup>
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  budget: Object,
});

const form = useForm({
  amount: null,
});

const submit = () => {
  form.post(route('budgets.payment', props.budget.data.id));
  form.reset();
};

const deleteBudget = () => {
  useForm({}).delete(route('budgets.destroy', props.budget.data.id));
};
</script>

<template>
  <AuthenticatedLayout>
    <h1 class="text-center text-4xl font-semibold">{{ budget.data.name }}</h1>
    <div class="mt-8 text-center">
      <h3 class="text-2xl font-semibold">
        ${{ (budget.data.amount / 100).toFixed(2) }}
      </h3>
      <h3 class="mt-2 text-xl" v-if="budget.data.show_daily_amount">
        (~${{ (budget.data.average_daily_amount / 100).toFixed(2) }}/day)
      </h3>
      <form @submit.prevent="submit" class="mt-4 flex justify-center gap-2">
        <TextInput autofocus type="number" step="0.01" v-model="form.amount" />
        <PrimaryButton>Make Payment</PrimaryButton>
      </form>
      <div class="mt-4 flex justify-center gap-4">
        <a :href="route('budgets.edit', budget.data.id)">
          <PrimaryButton>Edit</PrimaryButton>
        </a>
        <PrimaryButton @click.prevent="deleteBudget" class="bg-red-500"
          >Delete</PrimaryButton
        >
      </div>
    </div>
  </AuthenticatedLayout>
</template>
