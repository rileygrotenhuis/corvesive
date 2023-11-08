import publicRoutes from '~/libs/routes/publicRoutes.js';
import AccountService from '~/services/account.js';
import useAccountStore from '~/stores/account.js';
import usePayPeriodsStore from '~/stores/payPeriods.js';

export default defineNuxtRouteMiddleware(async (to, from) => {
  if (!publicRoutes.includes(to.path)) {
    if (!useAccountStore().user) {
      const authorizationCheck = await new AccountService().me();

      if (authorizationCheck.message === 'Unauthenticated.') {
        return navigateTo('/login');
      }

      useAccountStore().setUser(authorizationCheck.data);
    }
  }

  if (!usePayPeriodsStore().currentPayPeriod && useAccountStore().user?.pay_period?.id) {
    await usePayPeriodsStore().getPayPeriod(useAccountStore().user?.pay_period?.id);
  }
});
