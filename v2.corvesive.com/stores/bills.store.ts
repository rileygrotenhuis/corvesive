import { defineStore, StoreDefinition } from 'pinia';

export const useBillStore: StoreDefinition = defineStore('useBillStore', {
  state: () => ({
    bills: [],
    payPeriodBills: [],
  }),
  actions: {
    async getBills() {
      this.bills = await useNuxtApp().$api.bills.getBills();
    },
    async getPayPeriodBills(payPeriodId: Number) {
      this.payPeriodBills =
        await useNuxtApp().$api.bills.getPayPeriodBills(payPeriodId);
    },
  },
});
