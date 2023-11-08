import publicRoutes from '~/libs/routes/publicRoutes.ts';
import AccountService from '~/services/account.js';
import useAccountStore from '~/stores/account.js';
import usePayPeriodsStore from '~/stores/payPeriods.js';
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
