import usePayPeriodDashboardStore from '~/stores/payPeriodDashboard.ts';
import usePayPeriodPaystubsStore from '~/stores/payPeriodPaystubs.ts';
import usePayPeriodBillsStore from '~/stores/payPeriodBills.ts';
import usePayPeriodBudgetsStore from '~/stores/payPeriodBudgets.ts';
import usePayPeriodMetricsStore from '~/stores/payPeriodMetrics.ts';
import useTransactionsStore from '~/stores/transactions.ts';
import useMonthlyMetricsStore from '~/stores/monthlyMetrics.ts';
import useBillsStore from '~/stores/bills.ts';
import useBudgetsStore from '~/stores/budgets.ts';
import usePaystubsStore from '~/stores/paystubs.ts';

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
