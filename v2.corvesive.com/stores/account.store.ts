import { defineStore } from 'pinia';

export const useAccountStore = defineStore('useAccountStore', {
  state: () => ({
    me: {},
  }),
  actions: {
    async me() {
      this.me = await useNuxtApp().$api.account.me();
    },
  },
});
