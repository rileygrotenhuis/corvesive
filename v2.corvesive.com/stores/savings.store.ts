import { defineStore } from 'pinia';
import type {
  ISavingResource,
  IPayPeriodSavingResource,
} from '~/http/resources/savings.resource';

export const useSavingStore = defineStore('useSavingStore', {
  state: () => ({
    savings: [] as ISavingResource[],
    payPeriodSavings: [] as IPayPeriodSavingResource[],
  }),
  actions: {
    async getSavings(): Promise<ISavingResource[]> {
      this.savings = (await useNuxtApp().$api.savings.getSavings()).data;

      return this.savings;
    },
    async getPayPeriodSavings(
      payPeriodId: Number
    ): Promise<IPayPeriodSavingResource[]> {
      this.payPeriodSavings = (
        await useNuxtApp().$api.savings.getPayPeriodSavings(payPeriodId)
      ).data;

      return this.payPeriodSavings;
    },
  },
});
