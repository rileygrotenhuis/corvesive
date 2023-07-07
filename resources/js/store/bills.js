import { useForm } from '@inertiajs/vue3';
import { defineStore } from 'pinia';

const useBillsStore = defineStore('billsStore', {
  state: () => ({
    newBillsFormOpen: false,
    name: '',
    amount: 0,
  }),
  actions: {
    setNewBillsFormOpen(newBillsFormOpen) {
      this.newBillsFormOpen = newBillsFormOpen;
    },
    setName(name) {
      this.name = name;
    },
    setAmount(amount) {
      this.amount = amount;
    },
    createBill() {
      this.newBillsFormOpen = false;
      useForm({
        name: this.name,
        amount: parseInt(this.amount),
      }).post(route('bills.store'));
    },
  },
});

export default useBillsStore;
