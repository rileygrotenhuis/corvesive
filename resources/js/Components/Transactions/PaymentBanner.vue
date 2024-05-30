<script setup>
defineProps({
  payment: Object,
});
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
      <p>
        {{ payment.payment_day }}
      </p>
    </div>

    <div class="mt-2">
      <p class="text-sm text-primary-950">
        {{ payment.notes }}
      </p>
    </div>
  </a>
</template>
