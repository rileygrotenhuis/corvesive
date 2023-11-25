import { defineStore } from 'pinia';
import type {
  IPayPeriodPaystubResource,
  IPaystubResource,
} from '~/http/resources/paystubs.resource';

export const usePaystubStore = defineStore('usePaystubStore', {
  state: () => ({
    paystubs: [] as IPaystubResource[],
    paystub: {} as IPaystubResource,
    payPeriodPaystubs: [] as IPayPeriodPaystubResource[],
    payPeriodPaystub: {} as IPayPeriodPaystubResource,
  }),
  actions: {
    async getPaystubs(refresh: boolean = false): Promise<IPaystubResource[]> {
      if (refresh || this.paystubs.length === 0) {
        this.paystubs = (await useNuxtApp().$api.paystubs.getPaystubs()).data;
      }

      return this.paystubs;
    },
    async getPaystub(
      id: number,
      refresh: boolean = false
    ): Promise<IPaystubResource> {
      if (refresh || Object.keys(this.paystub).length === 0) {
        this.paystub = (await useNuxtApp().$api.paystubs.getPaystub(id)).data;
      }

      return this.paystub;
    },
    async getPayPeriodPaystubs(
      payPeriodId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodPaystubResource[]> {
      if (refresh || this.payPeriodPaystubs.length === 0) {
        this.payPeriodPaystubs = (
          await useNuxtApp().$api.paystubs.getPayPeriodPaystubs(payPeriodId)
        ).data;
      }

      return this.payPeriodPaystubs;
    },
    async getPayPeriodPaystub(
      payPeriodId: number,
      payPeriodPaystubId: number,
      refresh: boolean = false
    ): Promise<IPayPeriodPaystubResource> {
      if (refresh || Object.keys(this.payPeriodPaystub).length === 0) {
        this.payPeriodPaystub = (
          await useNuxtApp().$api.paystubs.getPayPeriodPaystub(
            payPeriodId,
            payPeriodPaystubId
          )
        ).data;
      }

      return this.payPeriodPaystub;
    },
  },
});
