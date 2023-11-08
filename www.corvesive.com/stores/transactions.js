import { defineStore } from 'pinia';
import usePayPeriodsStore from './payPeriods';
import useModalsStore from './modals';
import TransactionsService from '../services/transactions';
import handlePayPeriodAction from '~/util/handlePayPeriodAction.ts';

const useTransactionsStore = defineStore('useTransactionsStore', {
  state: () => ({
    transactions: [],
    form: {
      id: undefined,
      payPeriodExpense: undefined,
      amount: undefined,
      notes: undefined,
      isLoading: false,
      errors: false,
    },
  }),
  actions: {
    async getPayPeriodTransactions() {
      const getPayPeriodTransactionsResponse =
        await new TransactionsService().getPayPeriodTransactions(
          usePayPeriodsStore().currentPayPeriod.id
        );

      this.transactions = getPayPeriodTransactionsResponse.data;
    },
    async createBillTransaction() {
      this.form.isLoading = true;

      const createBillTransactionResponse =
        await new TransactionsService().createBillTransaction(
          usePayPeriodsStore().currentPayPeriod.id,
          this.form.payPeriodExpense.id
        );

      this.form.isLoading = false;

      this.form.errors = createBillTransactionResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        this.resetFormFields();
        await handlePayPeriodAction();
      }
    },
    async createBudgetTransaction() {
      this.form.isLoading = true;

      const createBudgetTransactionResponse =
        await new TransactionsService().createBudgetTransaction(
          usePayPeriodsStore().currentPayPeriod.id,
          this.form.payPeriodExpense.id,
          this.form.amount
        );

      this.form.isLoading = false;

      this.form.errors = createBudgetTransactionResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        this.resetFormFields();
        await handlePayPeriodAction();
      }
    },
    async makePayPeriodDeposit() {
      this.form.isLoading = true;

      const makePayPeriodDepositResponse =
        await new TransactionsService().makePayPeriodDeposit(
          usePayPeriodsStore().currentPayPeriod.id,
          this.form.amount,
          this.form.notes
        );

      this.form.isLoading = false;

      this.form.errors = makePayPeriodDepositResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        this.resetFormFields();
        await handlePayPeriodAction();
      }
    },
    async updateTransaction() {
      this.form.isLoading = true;

      const updateTransactionResponse =
        await new TransactionsService().updateTransaction(
          usePayPeriodsStore().currentPayPeriod.id,
          this.form.id,
          this.form.amount,
          this.form.notes
        );

      this.form.isLoading = false;

      this.form.errors = updateTransactionResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        this.resetFormFields();
        await handlePayPeriodAction();
      }
    },
    async deleteTransaction() {
      if (window.confirm('Are you sure you want to delete this bill?')) {
        this.form.isLoading = true;

        await new TransactionsService().deleteTransaction(
          usePayPeriodsStore().currentPayPeriod.id,
          this.form.id
        );

        this.form.isLoading = false;

        useModalsStore().closeModal();
        this.resetFormFields();
        await handlePayPeriodAction();
      }
    },
    populateFormFields(id, amount, notes) {
      this.form = {
        id: id,
        amount: (amount / 100).toFixed(2),
        notes: notes,
      };
    },
    resetFormFields() {
      this.form = {
        amount: undefined,
      };
    },
  },
});

export default useTransactionsStore;
