import { defineStore } from 'pinia';
import type { IPayPeriodResource } from '~/http/resources/payPeriods.resource';

export const usePayPeriodStore = defineStore('usePayPeriodStore', {
  state: () => ({
    payPeriods: [] as IPayPeriodResource[],
    currentPayPeriod: {} as IPayPeriodResource,
  }),
  actions: {
    async getPayPeriods(
      refresh: boolean = true
    ): Promise<IPayPeriodResource[]> {
      if (refresh || this.payPeriods.length === 0) {
        this.payPeriods = (
          await useNuxtApp().$api.payPeriods.getPayPeriods()
        ).data;
      }

      return this.payPeriods;
    },
    async getPayPeriod(id: number): Promise<IPayPeriodResource> {
      this.currentPayPeriod = (
        await useNuxtApp().$api.payPeriods.getPayPeriod(id)
      ).data;

      return this.currentPayPeriod;
    },
  },
});
