import { defineStore } from 'pinia';
import type { IPayPeriodResource } from '~/http/resources/payPeriods.resource';

export const usePayPeriodStore = defineStore('usePayPeriodStore', {
  state: () => ({
    payPeriods: [] as IPayPeriodResource[],
    currentPayPeriod: {} as IPayPeriodResource,
  }),
  actions: {
    async getPayPeriods() {
      this.payPeriods = await useNuxtApp().$api.payPeriods.getPayPeriods();

      return this.payPeriods;
    },
    async getPayPeriod(id: Number) {
      this.currentPayPeriod =
        await useNuxtApp().$api.payPeriods.getPayPeriod(id);

      return this.currentPayPeriod;
    },
  },
});
