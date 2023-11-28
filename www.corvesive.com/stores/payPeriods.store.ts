import { defineStore } from 'pinia';
import type {
  IPayPeriodMetricsResource,
  IPayPeriodResource,
} from '~/http/resources/payPeriods.resource';

export const usePayPeriodStore = defineStore('usePayPeriodStore', {
  state: () => ({
    payPeriods: [] as IPayPeriodResource[],
    currentPayPeriod: {} as IPayPeriodResource,
    metrics: {} as IPayPeriodMetricsResource,
  }),
  actions: {
    async getPayPeriods(
      refresh: boolean = false
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
    async getPayPeriodMetrics(
      id: number,
      refresh: boolean = false
    ): Promise<IPayPeriodMetricsResource> {
      if (refresh || Object.keys(this.metrics).length === 0) {
        this.metrics = (
          await useNuxtApp().$api.payPeriods.getPayPeriodMetrics(id)
        ).data;
      }

      return this.metrics;
    },
  },
});
