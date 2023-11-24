import { defineStore } from 'pinia';
import type {
  ISavingResource,
  IPayPeriodSavingResource,
} from '~/http/resources/savings.resource';

export const useSavingStore = defineStore('useSavingStore', {
  state: () => ({
    savings: [] as ISavingResource[],
    saving: {} as ISavingResource,
    payPeriodSavings: [] as IPayPeriodSavingResource[],
    payPeriodSaving: {} as IPayPeriodSavingResource,
  }),
  actions: {
    async getSavings(): Promise<ISavingResource[]> {
      this.savings = (await useNuxtApp().$api.savings.getSavings()).data;

      return this.savings;
    },
    async getSaving(id: number): Promise<ISavingResource> {
      this.saving = (await useNuxtApp().$api.savings.getSaving(id)).data;

      return this.saving;
    },
    async getPayPeriodSavings(
      payPeriodId: number
    ): Promise<IPayPeriodSavingResource[]> {
      this.payPeriodSavings = (
        await useNuxtApp().$api.savings.getPayPeriodSavings(payPeriodId)
      ).data;

      return this.payPeriodSavings;
    },
    async getPayPeriodSaving(
      payPeriodId: number,
      payPeriodSavingId: number
    ): Promise<IPayPeriodSavingResource> {
      this.payPeriodSaving = (
        await useNuxtApp().$api.savings.getPayPeriodSaving(
          payPeriodId,
          payPeriodSavingId
        )
      ).data;

      return this.payPeriodSaving;
    },
  },
});
