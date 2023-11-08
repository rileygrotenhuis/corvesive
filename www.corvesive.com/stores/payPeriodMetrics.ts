import { defineStore } from 'pinia';
import PayPeriodMetricsService from '../services/payPeriodMetrics';
import usePayPeriodsStore from './payPeriods';

const usePayPeriodMetricsStore = defineStore('usePayPeriodMetricsStore', {
  state: () => ({
    metrics: {},
  }),
  actions: {
    async getPayPeriodMetrics() {
      const payPeriodMetricsResponse =
        await new PayPeriodMetricsService().getPayPeriodMetrics(
          usePayPeriodsStore().currentPayPeriod.id
        );

      this.metrics = payPeriodMetricsResponse.data;
    },
  },
});

export default usePayPeriodMetricsStore;
