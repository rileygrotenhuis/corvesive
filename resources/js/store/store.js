import { defineStore } from 'pinia';

const useStore = defineStore('store', {
  state: () => ({
    expenseType: 'budget',
  }),
  actions: {
    setExpenseType(expenseType) {
      this.expenseType = expenseType;
    },
  },
});

export default useStore;
