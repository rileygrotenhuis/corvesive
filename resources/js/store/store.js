import { defineStore } from 'pinia';

const useStore = defineStore('store', {
  state: () => ({
    expenseType: 'budgets',
  }),
  actions: {
    setExpenseType(expenseType) {
      this.expenseType = expenseType;
    },
  },
});

export default useStore;
