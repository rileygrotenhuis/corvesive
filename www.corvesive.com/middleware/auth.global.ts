import publicRoutes from '~/libs/routes/publicRoutes';
import AccountService from '~/services/account';
import useAccountStore from '~/stores/account.ts';
import usePayPeriodsStore from '~/stores/payPeriods.ts';
import type { RouteLocationNormalized } from 'vue-router';

export default defineNuxtRouteMiddleware(
  async (to: RouteLocationNormalized, from: RouteLocationNormalized) => {
    if (!publicRoutes.includes(to.path)) {
      if (!useAccountStore().user) {
        const authorizationCheck = await new AccountService().me();

        if (authorizationCheck.message === 'Unauthenticated.') {
          return navigateTo('/login');
        }

        useAccountStore().setUser(authorizationCheck.data);
      }
    }

    if (
      !usePayPeriodsStore().currentPayPeriod &&
      useAccountStore().user?.pay_period?.id
    ) {
      await usePayPeriodsStore().getPayPeriod(
        useAccountStore().user?.pay_period?.id
      );
    }
  }
);
