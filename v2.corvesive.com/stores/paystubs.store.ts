import { defineStore, StoreDefinition } from 'pinia';

export const usePaystubStore: StoreDefinition = defineStore('usePaystubStore', {
  state: () => ({
    paystubs: [],
    payPeriodPaystubs: [],
  }),
  actions: {
    async getPaystubs() {
      this.paystubs = await useNuxtApp().$api.paystubs.getPaystubs();
    },
    async getPayPeriodPaystubs(payPeriodId: Number) {
      this.payPeriodPaystubs =
        await useNuxtApp().$api.paystubs.getPayPeriodPaystubs(payPeriodId);
    },
  },
});
