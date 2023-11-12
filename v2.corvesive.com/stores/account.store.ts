import { defineStore, StoreDefinition } from 'pinia';

export const useAccountStore: StoreDefinition = defineStore('useAccountStore', {
  state: () => ({
    user: null,
  }),
  actions: {
    async me() {
      this.me = await useNuxtApp().$api.account.me();
    },
  },
});
