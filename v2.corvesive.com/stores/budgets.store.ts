import { defineStore } from 'pinia';

export const useBudgetStore = defineStore('useBudgetStore', {
  state: () => ({
    budgets: [],
    payPeriodBudgets: [],
  }),
  actions: {
    async getBudgets() {
      this.budgets = await useNuxtApp().$api.budgets.getBudgets();
    },
    async getPayPeriodBudgets(payPeriodId: Number) {
      this.payPeriodBudgets =
        await useNuxtApp().$api.budgets.getPayPeriodBudgets(payPeriodId);
    },
  },
});
