<script setup>
import PrimaryButton from '@/Components/PrimaryButton.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  saving: Object,
});

const form = useForm({
  amount: null,
});

const submit = () => {
  form.post(
    props.saving.data.is_payed
      ? route('savings.unpayment', props.saving.data.id)
      : route('savings.payment', props.saving.data.id)
  );
  form.reset();
};

const deleteSaving = () => {
  useForm({}).delete(route('savings.destroy', props.saving.data.id));
};
</script>

<template>
  <AuthenticatedLayout>
    <h1 class="text-center text-4xl font-semibold">{{ saving.data.name }}</h1>
    <div class="mt-8 text-center">
      <h3 class="text-2xl font-semibold">
        ${{ (saving.data.amount / 100).toFixed(2) }}
      </h3>
      <h3 class="mt-2 text-xl">(payment status will go here)</h3>
      <form @submit.prevent="submit" class="mt-4 flex justify-center gap-2">
        <PrimaryButton v-if="saving.data.is_payed">Unpay Bill</PrimaryButton>
        <PrimaryButton v-else>Pay Bill</PrimaryButton>
      </form>
      <div class="mt-4 flex justify-center gap-4">
        <a :href="route('savings.edit', saving.data.id)">
          <PrimaryButton>Edit</PrimaryButton>
        </a>
        <PrimaryButton @click.prevent="deleteSaving" class="bg-red-500"
          >Delete</PrimaryButton
        >
      </div>
    </div>
  </AuthenticatedLayout>
</template>
