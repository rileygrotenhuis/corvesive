import { defineStore } from 'pinia';

export const usePayPeriodStore = defineStore('usePayPeriodStore', {
  state: () => ({
    payPeriods: [],
    currentPayPeriod: {},
  }),
  actions: {
    async getPayPeriods() {
      this.payPeriods = await useNuxtApp().$api.payPeriods.getPayPeriods();
    },
    async getPayPeriod(id: Number) {
      this.currentPayPeriod =
        await useNuxtApp().$api.payPeriods.getPayPeriod(id);
    },
  },
});
