import { defineStore } from 'pinia';
import type {
  IBudgetResource,
  IPayPeriodBudgetResource,
} from '~/http/resources/budgets.resource';

export const useBudgetStore = defineStore('useBudgetStore', {
  state: () => ({
    budgets: [] as IBudgetResource[],
    budget: {} as IBudgetResource,
    payPeriodBudgets: [] as IPayPeriodBudgetResource[],
    payPeriodBudget: {} as IPayPeriodBudgetResource,
  }),
  actions: {
    async getBudgets(): Promise<IBudgetResource[]> {
      this.budgets = (await useNuxtApp().$api.budgets.getBudgets()).data;

      return this.budgets;
    },
    async getBudget(id: number): Promise<IBudgetResource> {
      this.budget = (await useNuxtApp().$api.budgets.getBudget(id)).data;

      return this.budget;
    },
    async getPayPeriodBudgets(
      payPeriodId: number
    ): Promise<IPayPeriodBudgetResource[]> {
      this.payPeriodBudgets = (
        await useNuxtApp().$api.budgets.getPayPeriodBudgets(payPeriodId)
      ).data;

      return this.payPeriodBudgets;
    },
    async getPayPeriodBudget(
      payPeriodId: number,
      payPeriodBudgetId: number
    ): Promise<IPayPeriodBudgetResource> {
      this.payPeriodBudget = (
        await useNuxtApp().$api.budgets.getPayPeriodBudget(
          payPeriodId,
          payPeriodBudgetId
        )
      ).data;

      return this.payPeriodBudget;
    },
  },
});
