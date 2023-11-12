import { defineStore } from 'pinia';
import type {
  IBillResource,
  IPayPeriodBillResource,
} from '~/http/resources/bills.resource';

export const useBillStore = defineStore('useBillStore', {
  state: () => ({
    bills: [] as IBillResource[],
    payPeriodBills: [] as IPayPeriodBillResource[],
  }),
  actions: {
    async getBills(): Promise<IBillResource[]> {
      this.bills = await useNuxtApp().$api.bills.getBills();

      return this.bills;
    },
    async getPayPeriodBills(
      payPeriodId: Number
    ): Promise<IPayPeriodBillResource[]> {
      this.payPeriodBills =
        await useNuxtApp().$api.bills.getPayPeriodBills(payPeriodId);

      return this.payPeriodBills;
    },
  },
});
