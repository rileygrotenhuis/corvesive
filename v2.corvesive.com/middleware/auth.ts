import type { IUserResource } from '~/http/resources/account.resource';

export default defineNuxtRouteMiddleware(async (to, from) => {
  if (Object.keys(useAccountStore().user).length > 0) {
    return;
  }

  const me: IUserResource = await useNuxtApp().$api.account.me();

  if (!me) {
    return await navigateTo('/login');
  }
});
