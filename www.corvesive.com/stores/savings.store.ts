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
    async getSavings(refresh: boolean = false): Promise<ISavingResource[]> {
      if (refresh || this.savings.length === 0) {
        this.savings = (await useNuxtApp().$api.savings.getSavings()).data;
      }

      return this.savings;
    },
    async getSaving(
      id: number,
      refresh: boolean = false
    ): Promise<ISavingResource> {
      if (refresh || Object.keys(this.saving).length === 0) {
        this.saving = (await useNuxtApp().$api.savings.getSaving(id)).data;
      }

      return this.saving;
    },
    async getPayPeriodSavings(
      payPeriodId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodSavingResource[]> {
      if (refresh || this.payPeriodSavings.length === 0) {
        this.payPeriodSavings = (
          await useNuxtApp().$api.savings.getPayPeriodSavings(payPeriodId)
        ).data;
      }

      return this.payPeriodSavings;
    },
    async getPayPeriodSaving(
      payPeriodId: number,
      payPeriodSavingId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodSavingResource> {
      if (refresh || Object.keys(this.payPeriodSaving).length === 0) {
        this.payPeriodSaving = (
          await useNuxtApp().$api.savings.getPayPeriodSaving(
            payPeriodId,
            payPeriodSavingId
          )
        ).data;
      }

      return this.payPeriodSaving;
    },
  },
});
