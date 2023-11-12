import { defineStore, StoreDefinition } from 'pinia';

export const usePaystubStore: StoreDefinition = defineStore('usePaystubStore', {
  state: () => ({
    paystubs: [],
  }),
  actions: {
    async getPaystubs() {
      this.paystubs = await useNuxtApp().$api.paystubs.getPaystubs();
    },
  },
});
