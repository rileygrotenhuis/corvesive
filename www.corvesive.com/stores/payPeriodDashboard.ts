import { defineStore } from 'pinia';
import PayPeriodDashboardService from '~/services/payPeriodDashboard';
import usePayPeriodsStore from '~/stores/payPeriods.ts';

const usePayPeriodDashboardStore = defineStore('usePayPeriodDashboardStore', {
  state: () => ({
    data: {},
  }),
  actions: {
    async getPayPeriodDashboardMetrics() {
      const payPeriodDashboardMetricsResponse =
        await new PayPeriodDashboardService().getPayPeriodDashboardMetrics(
          usePayPeriodsStore().currentPayPeriod.id
        );

      this.data = payPeriodDashboardMetricsResponse.data;
    },
  },
});

export default usePayPeriodDashboardStore;
