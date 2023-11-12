import { defineStore, StoreDefinition } from 'pinia';

export const usePayPeriodStore: StoreDefinition = defineStore(
  'usePayPeriodStore',
  {
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
  }
);
