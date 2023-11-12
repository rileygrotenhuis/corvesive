import { defineStore } from 'pinia';

export const useBillStore = defineStore('useBillStore', {
  state: () => ({
    bills: [],
    payPeriodBills: [],
  }),
  actions: {
    async getBills() {
      this.bills = await useNuxtApp().$api.bills.getBills();

      return this.bills;
    },
    async getPayPeriodBills(payPeriodId: Number) {
      this.payPeriodBills =
        await useNuxtApp().$api.bills.getPayPeriodBills(payPeriodId);

      return this.payPeriodBills;
    },
  },
});
