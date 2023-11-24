import type { IUserResource } from '~/http/resources/account.resource';

export default defineNuxtRouteMiddleware(async (to, from) => {
  if (to.path === '/') {
    return await navigateTo('/income');
  }

  const accountStore = useAccountStore();
  const payPeriodStore = usePayPeriodStore();
  const accessToken = useCookie('corvesive_access_token').value;

  const isUserLoggedIn =
    Object.keys(accountStore.user).length > 0 && accessToken;

  if (!isUserLoggedIn) {
    const me: IUserResource = await accountStore.me();

    if (!me) {
      return await navigateTo('/login');
    }

    if (payPeriodStore.payPeriods.length < 1) {
      await payPeriodStore.getPayPeriods();
    }

    if (Object.keys(payPeriodStore.currentPayPeriod).length < 1) {
      await payPeriodStore.getPayPeriod(me.pay_period.id);
    }
  }
});
