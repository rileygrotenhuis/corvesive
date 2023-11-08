import usePayPeriodDashboardStore from '~/stores/payPeriodDashboard.js';
import usePayPeriodPaystubsStore from '~/stores/payPeriodPaystubs.js';
import usePayPeriodBillsStore from '~/stores/payPeriodBills.js';
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets.js';
import usePayPeriodMetricsStore from '~/stores/payPeriodMetrics.js';
import useTransactionsStore from '~/stores/transactions.js';
import useMonthlyMetricsStore from '~/stores/monthlyMetrics.js';
import useBillsStore from '~/stores/bills.js';
import useBudgetsStore from '~/stores/budgets.js';
import usePaystubsStore from '~/stores/paystubs.js';

export default async function () {
  const dataReloadMappings: Object = {
    '/dashboard': usePayPeriodDashboardStore().getPayPeriodDashboardMetrics,
    '/dashboard/paystubs': usePayPeriodPaystubsStore().getPayPeriodPaystubs,
    '/dashboard/bills': usePayPeriodBillsStore().getPayPeriodBills,
    '/dashboard/budgets': usePayPeriodBudgetsStore().getPayPeriodBudgets,
    '/dashboard/metrics': usePayPeriodMetricsStore().getPayPeriodMetrics,
    '/dashboard/transactions': useTransactionsStore().getPayPeriodTransactions,
    '/monthly': useMonthlyMetricsStore().getMonthlyMetrics,
    '/monthly/paystubs': usePaystubsStore().getPaystubs,
    '/monthly/bills': useBillsStore().getBills,
    '/monthly/budgets': useBudgetsStore().getBudgets,
  };

  if (dataReloadMappings[window.location.pathname]) {
    await dataReloadMappings[window.location.pathname]();
  }
}
