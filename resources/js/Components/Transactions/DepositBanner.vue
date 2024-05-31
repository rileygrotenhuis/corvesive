<script setup>
import UnscheduleIcon from '@/Components/Icons/UnscheduleIcon.vue';
import { useForm } from '@inertiajs/vue3';

const props = defineProps({
  deposit: Object,
});

const refundDeposit = () => {
  if (confirm('Are you sure you want to refund this deposit?')) {
    useForm({}).delete(route('deposits.destroy', props.deposit.id), {
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
        ${{ deposit.amount }}
      </h4>
      <div class="flex gap-4 items-center">
        <p>
          {{ deposit.deposit_day }}
        </p>
        <UnscheduleIcon class="w-5 h-5" @click.prevent="refundDeposit" />
      </div>
    </div>

    <div class="mt-2">
      <p class="text-sm text-primary-950">
        {{ deposit.notes }}
      </p>
    </div>
  </a>
</template>
