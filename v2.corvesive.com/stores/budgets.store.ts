import { defineStore } from 'pinia';
import type {
  IBudgetResource,
  IPayPeriodBudgetResource,
} from '~/http/resources/budgets.resource';

export const useBudgetStore = defineStore('useBudgetStore', {
  state: () => ({
    budgets: [] as IBudgetResource[],
    payPeriodBudgets: [] as IPayPeriodBudgetResource[],
  }),
  actions: {
    async getBudgets() {
      this.budgets = await useNuxtApp().$api.budgets.getBudgets();

      return this.budgets;
    },
    async getPayPeriodBudgets(payPeriodId: Number) {
      this.payPeriodBudgets =
        await useNuxtApp().$api.budgets.getPayPeriodBudgets(payPeriodId);

      return this.payPeriodBudgets;
    },
  },
});
