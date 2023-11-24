import { defineStore } from 'pinia';
import type { ITransactionResource } from '~/http/resources/transactions.resource';

export const useTransactionStore = defineStore('useTransactionStore', {
  state: () => ({
    transactions: [] as ITransactionResource[],
    deposits: [] as ITransactionResource[],
  }),
  actions: {
    async getPayPeriodTransactions(
      payPeriodId: number
    ): Promise<ITransactionResource[]> {
      this.transactions = (
        await useNuxtApp().$api.transactions.getPayPeriodTransactions(
          payPeriodId
        )
      ).data;

      return this.transactions;
    },
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
