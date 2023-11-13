import type { IUserResource } from '~/http/resources/account.resource';

export default defineNuxtRouteMiddleware(async (to, from) => {
  const accountStore = useAccountStore();
  const payPeriodStore = usePayPeriodStore();

  if (Object.keys(accountStore.user).length < 1 || !useCookie('corvesive_access_token').value) {
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
