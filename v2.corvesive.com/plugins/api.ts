import { defineNuxtPlugin } from '#app';
import AuthService from '~/services/auth.service';
import AccountService from '~/services/account.service';
import PaystubService from '~/services/paystubs.service';
import BillService from '~/services/bills.service';
import BudgetService from '~/services/budgets.service';
import PayPeriodService from '~/services/payPeriods.service';

interface IApiInstance {
  auth: AuthService;
  account: AccountService;
  paystubs: PaystubService;
  bills: BillService;
  budgets: BudgetService;
  payPeriods: PayPeriodService;
}

export default defineNuxtPlugin((nuxtApp) => {
  const modules: IApiInstance = {
    auth: new AuthService(),
    account: new AccountService(),
    paystubs: new PaystubService(),
    bills: new BillService(),
    budgets: new BudgetService(),
    payPeriods: new PayPeriodService(),
  };

  return {
    provide: {
      api: modules,
    },
  };
});
