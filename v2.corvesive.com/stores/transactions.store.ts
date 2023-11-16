import { defineStore } from 'pinia';
import type {
  ISavingResource,
  IPayPeriodSavingResource,
} from '~/http/resources/savings.resource';
import type { ITransactionResource } from '~/http/resources/transactions.resource';

export const useTransactionStore = defineStore('useTransactionStore', {
  state: () => ({
    deposits: [] as ITransactionResource[],
  }),
  actions: {
    async getPayPeriodDeposits(
      payPeriodId: number
    ): Promise<ITransactionResource[]> {
      this.deposits = (
        await useNuxtApp().$api.transactions.getPayPeriodDeposits(payPeriodId)
      ).data;

      return this.deposits;
    },
  },
});
