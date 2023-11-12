import { defineStore } from 'pinia';
import type { IUserResource } from '~/http/resources/account.resource';

export const useAccountStore = defineStore('useAccountStore', {
  state: () => ({
    user: {} as IUserResource,
  }),
  actions: {
    async me() {
      this.user = await useNuxtApp().$api.account.me();

      return this.me;
    },
  },
});
