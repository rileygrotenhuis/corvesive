import { defineStore } from 'pinia';
import type {
  IBillResource,
  IPayPeriodBillResource,
} from '~/http/resources/bills.resource';

export const useBillStore = defineStore('useBillStore', {
  state: () => ({
    bills: [] as IBillResource[],
    bill: {} as IBillResource,
    payPeriodBills: [] as IPayPeriodBillResource[],
    payPeriodBill: {} as IPayPeriodBillResource,
  }),
  actions: {
    async getBills(refresh: boolean = false): Promise<IBillResource[]> {
      if (refresh || this.bills.length === 0) {
        this.bills = (await useNuxtApp().$api.bills.getBills()).data;
      }

      return this.bills;
    },
    async getBill(
      id: number,
      refresh: boolean = false
    ): Promise<IBillResource> {
      if (refresh || Object.keys(this.bill).length === 0) {
        this.bill = (await useNuxtApp().$api.bills.getBill(id)).data;
      }

      return this.bill;
    },
    async getPayPeriodBills(
      payPeriodId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodBillResource[]> {
      if (refresh || this.payPeriodBills.length === 0) {
        this.payPeriodBills = (
          await useNuxtApp().$api.bills.getPayPeriodBills(payPeriodId)
        ).data;
      }

      return this.payPeriodBills;
    },
    async getPayPeriodBill(
      payPeriodId: number,
      payPeriodBillId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodBillResource> {
      if (refresh || Object.keys(this.payPeriodBill).length === 0) {
        this.payPeriodBill = (
          await useNuxtApp().$api.bills.getPayPeriodBill(
            payPeriodId,
            payPeriodBillId
          )
        ).data;
      }

      return this.payPeriodBill;
    },
  },
});
