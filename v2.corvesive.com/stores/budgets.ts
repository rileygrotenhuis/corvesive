import { defineStore, StoreDefinition } from 'pinia';

export const useBudgetStore: StoreDefinition = defineStore('useBudgetStore', {
  state: () => ({
    budgets: [],
  }),
  actions: {
    async getBudgets() {
      this.budgets = await useNuxtApp().$api.budgets.getBudgets();
    },
  },
});
