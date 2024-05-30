<script setup>
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  payment: Object,
});

const refundPayment = () => {
  if (confirm('Are you sure you want to refund this payment?')) {
    useForm({}).delete(route('payments.destroy', props.payment.id), {
      preserveState: true,
      preserveScroll: true,
    });
  }
};
</script>

<template>
  <a
    href="#"
    class="block w-full bg-primary-100 hover:bg-primary-300 p-4 rounded-md cursor-pointer"
  >
    <div class="flex justify-between items-center">
      <h4 class="text-lg font-semibold text-primary-950">
        ${{ payment.amount }}
      </h4>
      <div class="flex gap-4 items-center">
        <p>
          {{ payment.payment_day }}
        </p>
        <UnscheduleIcon class="w-5 h-5" @click.prevent="refundPayment" />
      </div>
    </div>

    <div class="mt-2">
      <p class="text-sm text-primary-950">
        {{ payment.notes }}
      </p>
    </div>
  </a>
</template>
