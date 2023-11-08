import { defineStore } from 'pinia';
import MonthlyMetricsService from '~/services/monthlyMetrics';

const useMonthlyMetricsStore = defineStore('useMonthlyMetricsStore', {
  state: () => ({
    metrics: undefined,
  }),
  actions: {
    async getMonthlyMetrics() {
      const getMonthlyMetricsResponse =
        await new MonthlyMetricsService().getMonthlyMetrics();

      this.metrics = getMonthlyMetricsResponse.data;
    },
  },
});

export default useMonthlyMetricsStore;
