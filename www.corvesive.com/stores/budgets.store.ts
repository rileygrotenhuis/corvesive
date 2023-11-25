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
    async getBudgets(refresh: boolean = false): Promise<IBudgetResource[]> {
      if (refresh || this.budgets.length === 0) {
        this.budgets = (await useNuxtApp().$api.budgets.getBudgets()).data;
      }

      return this.budgets;
    },
    async getBudget(
      id: number,
      refresh: boolean = false
    ): Promise<IBudgetResource> {
      if (refresh || Object.keys(this.budget).length === 0) {
        this.budget = (await useNuxtApp().$api.budgets.getBudget(id)).data;
      }

      return this.budget;
    },
    async getPayPeriodBudgets(
      payPeriodId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodBudgetResource[]> {
      if (refresh || this.payPeriodBudgets.length === 0) {
        this.payPeriodBudgets = (
          await useNuxtApp().$api.budgets.getPayPeriodBudgets(payPeriodId)
        ).data;
      }

      return this.payPeriodBudgets;
    },
    async getPayPeriodBudget(
      payPeriodId: number,
      payPeriodBudgetId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodBudgetResource> {
      if (refresh || Object.keys(this.payPeriodBudget).length === 0) {
        this.payPeriodBudget = (
          await useNuxtApp().$api.budgets.getPayPeriodBudget(
            payPeriodId,
            payPeriodBudgetId
          )
        ).data;
      }

      return this.payPeriodBudget;
    },
  },
});
