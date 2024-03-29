import type { IUserResource } from '~/http/resources/account.resource';

export default defineNuxtRouteMiddleware(async (to, from) => {
  const accountStore = useAccountStore();
  const payPeriodStore = usePayPeriodStore();
  const accessToken = useCookie('corvesive_access_token', {
    maxAge: 60 * 60 * 24 * 7,
    path: '/',
  }).value;

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

    if (Object.keys(accountStore.user.pay_period).length < 1) {
      await payPeriodStore.getPayPeriod(me.pay_period.id);
    }
  }
});
