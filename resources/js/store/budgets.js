import { useForm } from '@inertiajs/vue3';
import { defineStore } from 'pinia';

const useBudgetsStore = defineStore('budgetsStore', {
  state: () => ({
    newBudgetsFormOpen: false,
    name: '',
    amount: 0,
    showDailyAmount: false,
  }),
  actions: {
    setNewBudgetsFormOpen(newBudgetsFormOpen) {
      this.newBudgetsFormOpen = newBudgetsFormOpen;
    },
    setName(name) {
      this.name = name;
    },
    setAmount(amount) {
      this.amount = amount;
    },
    setShowDailyAmount(showDailyAmount) {
      this.showDailyAmount = showDailyAmount;
    },
    createBudget() {
      this.newBudgetsFormOpen = false;
      useForm({
        name: this.name,
        amount: parseInt(this.amount),
        show_daily_amount: this.showDailyAmount,
      }).post(route('budgets.store'));
    },
  },
});

export default useBudgetsStore;
