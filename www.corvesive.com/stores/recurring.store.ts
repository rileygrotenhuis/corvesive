import { defineStore } from 'pinia';
import type { IRecurringMetricsResource } from '~/http/resources/recurring.resource';

export const useRecurringStore = defineStore('useRecurringStore', {
  state: () => ({
    metrics: {} as IRecurringMetricsResource,
  }),
  actions: {
    async getRecurringMetrics(
      refresh: boolean = false
    ): Promise<IRecurringMetricsResource> {
      if (refresh || Object.keys(this.metrics).length === 0) {
        this.metrics = (
          await useNuxtApp().$api.recurring.getRecurringMetrics()
        ).data;
      }

      return this.metrics;
    },
  },
});
