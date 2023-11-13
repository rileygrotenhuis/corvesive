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
    async getBudgets(): Promise<IBudgetResource[]> {
      this.budgets = (await useNuxtApp().$api.budgets.getBudgets()).data;

      return this.budgets;
    },
    async getPayPeriodBudgets(
      payPeriodId: Number
    ): Promise<IPayPeriodBudgetResource[]> {
      this.payPeriodBudgets = (
        await useNuxtApp().$api.budgets.getPayPeriodBudgets(payPeriodId)
      ).data;

      return this.payPeriodBudgets;
    },
  },
});
