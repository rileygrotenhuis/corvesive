<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import { computed, onMounted, ref } from 'vue';

const user = usePage().props.auth.user;

const dropdownOpen = ref(false);

onMounted(() => {
  window.addEventListener('click', (event) => {
    if (!event.target.closest('.relative')) {
      dropdownOpen.value = false;
    }
  });
});

const initials = computed(() => {
  return usePage().props.auth.user.initials;
});

const logout = () => {
  useForm({}).delete(route('logout'));
};
</script>

<template>
  <div class="relative inline-block text-left">
    <div
      @click="dropdownOpen = !dropdownOpen"
      class="bg-white p-2 rounded-full font-bold text-primary-1000 cursor-pointer"
    >
      {{ initials }}
    </div>
    <div
      v-if="dropdownOpen"
      class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5"
    >
      <div class="py-1">
        <a
          :href="route('profile.edit')"
          class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
          >Profile</a
        >
        <button
          class="w-full block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 text-left"
          @click.prevent="logout"
        >
          Logout
        </button>
      </div>
    </div>
  </div>
</template>
