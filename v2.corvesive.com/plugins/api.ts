import { $fetch, FetchOptions } from 'ofetch';
import { defineNuxtPlugin } from '#app';
import AuthService from '~/services/auth.service';
import AccountService from '~/services/account.service';
import PaystubService from '~/services/paystubs.service';
import BillService from '~/services/bills.service';
import BudgetService from '~/services/budgets.service';

interface IApiInstance {
  auth: AuthService;
  account: AccountService;
  paystubs: PaystubService;
  bills: BillService;
  budgets: BudgetService;
}

export default defineNuxtPlugin((nuxtApp) => {
  const fetchOptions: FetchOptions = {
    baseURL: nuxtApp.$config.public.apiUrl,
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
      Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
    },
  };

  const apiFetcher = $fetch.create(fetchOptions);

  const modules: IApiInstance = {
    auth: new AuthService(apiFetcher),
    account: new AccountService(apiFetcher),
    paystubs: new PaystubService(apiFetcher),
    bills: new BillService(apiFetcher),
    budgets: new BudgetService(apiFetcher),
  };

  return {
    provide: {
      api: modules,
    },
  };
});
