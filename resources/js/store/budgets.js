import { useForm } from '@inertiajs/vue3';
import { defineStore } from 'pinia';

const useBudgetsStore = defineStore('budgetsStore', {
  state: () => ({
    currentBudget: null,
    newBudgetsFormOpen: false,
    budgetPaymentFormOpen: false,
    name: '',
    amount: 0,
    showDailyAmount: false,
    paymentAmount: null,
  }),
  actions: {
    setNewBudgetsFormOpen(newBudgetsFormOpen) {
      this.newBudgetsFormOpen = newBudgetsFormOpen;
    },
    setBudgetPaymentFormOpen(budgetPaymentFormOpen, currentBudget) {
      this.budgetPaymentFormOpen = budgetPaymentFormOpen;
      this.currentBudget = currentBudget;
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
    setPaymentAmount(paymentAmount) {
      this.paymentAmount = paymentAmount;
    },
    createBudget() {
      this.newBudgetsFormOpen = false;
      useForm({
        name: this.name,
        amount: parseInt(this.amount),
        show_daily_amount: this.showDailyAmount,
      }).post(route('budgets.store'));
    },
    makeBudgetPayment(budgetId) {
      this.budgetPaymentFormOpen = false;
      useForm({
        amount: this.paymentAmount,
      }).post(route('budgets.payment', budgetId));
      this.paymentAmount = null;
    },
  },
});

export default useBudgetsStore;
