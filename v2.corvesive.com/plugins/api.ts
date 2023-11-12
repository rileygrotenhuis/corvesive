import { $fetch, FetchOptions } from 'ofetch';
import { defineNuxtPlugin } from '#app';
import AuthService from '~/services/auth';
import AccountService from '~/services/account';

interface IApiInstance {
  auth: AuthService;
  account: AccountService;
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
  };

  return {
    provide: {
      api: modules,
    },
  };
});
