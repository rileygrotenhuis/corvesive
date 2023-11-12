import { defineStore } from 'pinia';

export const useBillStore = defineStore('useBillStore', {
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
