import { defineStore, StoreDefinition } from 'pinia';

export const useBudgetStore: StoreDefinition = defineStore('useBudgetStore', {
  state: () => ({
    budgets: [],
    payPeriodBudgets: [],
  }),
  actions: {
    async getBudgets() {
      this.budgets = await useNuxtApp().$api.budgets.getBudgets();
    },
    async getPayPeriodBudgets() {
      this.payPeriodBudgets =
        await useNuxtApp().$api.budgets.getPayPeriodBudgets();
    },
  },
});
