import { defineStore, StoreDefinition } from 'pinia';

export const useBillStore: StoreDefinition = defineStore('useBillStore', {
  state: () => ({
    bills: [],
  }),
  actions: {
    async getBills() {
      this.bills = await useNuxtApp().$api.bills.getBills();
    },
  },
});
