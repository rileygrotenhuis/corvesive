<script setup>
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';
import { useForm } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
  transaction: Object,
  showType: Boolean,
});

const amount = computed(() => {
  return props.transaction.amount.toLocaleString('en-US', {
    style: 'currency',
    currency: 'USD',
  });
});

const refundDeposit = () => {
  if (confirm('Are you sure you want to refund this deposit?')) {
    useForm({}).delete(route('deposits.destroy', props.transaction.id), {
      preserveState: true,
      preserveScroll: true,
    });
  }
};
</script>

<template>
  <a
    href="#"
    class="block w-full bg-primary-100 hover:bg-primary-300 p-4 rounded-md cursor-pointer text-black"
  >
    <div class="flex justify-between items-center">
      <div>
        <h4 class="text-lg font-semibold text-primary-950">
          {{ amount }}
        </h4>
        <p v-if="showType" class="text-sm text-gray-600">Deposit</p>
      </div>
      <div class="flex gap-4 items-center">
        <p>
          {{ transaction.deposit_day }}
        </p>
        <UnscheduleIcon class="w-5 h-5" @click.prevent="refundDeposit" />
      </div>
    </div>

    <div class="mt-2">
      <p class="text-sm text-primary-950">
        {{ transaction.notes }}
      </p>
    </div>
  </a>
</template>
