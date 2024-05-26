<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  bill: Object,
});

const form = useForm({
  amount: null,
});

const submit = () => {
  form.post(
    props.bill.data.is_payed
      ? route('bills.unpayment', props.bill.data.id)
      : route('bills.payment', props.bill.data.id)
  );
  form.reset();
};

const deleteBill = () => {
  useForm({}).delete(route('bills.destroy', props.bill.data.id));
};
</script>

<template>
  <AuthenticatedLayout>
    <h1 class="text-center text-4xl font-semibold">{{ bill.data.name }}</h1>
    <div class="mt-8 text-center">
      <h3 class="text-2xl font-semibold">
        ${{ (bill.data.amount / 100).toFixed(2) }}
      </h3>
      <h3 class="mt-2 text-xl">(payment status will go here)</h3>
      <form @submit.prevent="submit" class="mt-4 flex justify-center gap-2">
        <PrimaryButton v-if="bill.data.is_payed">Unpay Bill</PrimaryButton>
        <PrimaryButton v-else>Pay Bill</PrimaryButton>
      </form>
      <div class="mt-4 flex justify-center gap-4">
        <a :href="route('bills.edit', bill.data.id)">
          <PrimaryButton>Edit</PrimaryButton>
        </a>
        <PrimaryButton @click.prevent="deleteBill" class="bg-red-500"
          >Delete</PrimaryButton
        >
      </div>
    </div>
  </AuthenticatedLayout>
</template>
