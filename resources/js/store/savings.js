import { useForm } from '@inertiajs/vue3';
import { defineStore } from 'pinia';

const useSavingsStore = defineStore('savingsStore', {
  state: () => ({
    newSavingsFormOpen: false,
    name: '',
    amount: 0,
  }),
  actions: {
    setNewSavingsFormOpen(newSavingsFormOpen) {
      this.newSavingsFormOpen = newSavingsFormOpen;
    },
    setName(name) {
      this.name = name;
    },
    setAmount(amount) {
      this.amount = amount;
    },
    createSavings() {
      this.newSavingsFormOpen = false;
      useForm({
        name: this.name,
        amount: parseInt(this.amount),
      }).post(route('savings.store'));
    },
  },
});

export default useSavingsStore;
