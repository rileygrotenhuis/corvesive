import { defineStore } from 'pinia';
import type { ITransactionResource } from '~/http/resources/transactions.resource';

export const useTransactionStore = defineStore('useTransactionStore', {
  state: () => ({
    transactions: [] as ITransactionResource[],
    deposits: [] as ITransactionResource[],
  }),
  actions: {
    async getPayPeriodTransactions(
      payPeriodId: number,
      refresh: boolean = false
    ): Promise<ITransactionResource[]> {
      if (refresh || this.transactions.length === 0) {
        this.transactions = (
          await useNuxtApp().$api.transactions.getPayPeriodTransactions(
            payPeriodId
          )
        ).data;
      }

      return this.transactions;
    },
    async getPayPeriodDeposits(
      payPeriodId: number,
      refresh: boolean = false
    ): Promise<ITransactionResource[]> {
      if (refresh || this.deposits.length === 0) {
        this.deposits = (
          await useNuxtApp().$api.transactions.getPayPeriodDeposits(payPeriodId)
        ).data;
      }

      return this.deposits;
    },
  },
});
