import { defineStore } from 'pinia';
import usePayPeriodsStore from '~/stores/payPeriods';
import PayPeriodBudgetsService from '~/services/payPeriodBudgets';
import useModalsStore from '~/stores/modals.ts';

const usePayPeriodBudgetsStore = defineStore('usePayPeriodBudgetsStore', {
  state: () => ({
    payPeriodBudgets: [],
    selectedPayPeriodBudget: {},
    form: {
      payPeriodId: -1,
      budgetId: -1,
      totalBalance: '',
      remainingBalance: '',
      isLoading: false,
      errors: null,
    },
  }),
  actions: {
    async getPayPeriodBudgets() {
      const payPeriodBudgetsResponse =
        await new PayPeriodBudgetsService().getPayPeriodBudgets(
          usePayPeriodsStore().currentPayPeriod.id
        );

      this.payPeriodBudgets = payPeriodBudgetsResponse.data;
    },
    async attachBudgetToPayPeriod() {
      this.form.isLoading = true;

      const attachBudgetToPayPeriodResponse =
        await new PayPeriodBudgetsService().attachBudgetToPayPeriod(
          this.form.payPeriodId,
          this.form.budgetId,
          parseInt(this.form.totalBalance)
        );

      this.form.isLoading = false;

      this.form.errors = attachBudgetToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBudgets();
        await usePayPeriodsStore().setCurrentPayPeriod(
          attachBudgetToPayPeriodResponse.data
        );
      }
    },
    async updatePayPeriodBudget() {
      this.form.isLoading = true;

      const updatePayPeriodBudgetResponse =
        await new PayPeriodBudgetsService().updatePayPeriodBudget(
          this.form.payPeriodId,
          this.form.budgetId,
          parseInt(this.form.totalBalance),
          parseInt(this.form.remainingBalance)
        );

      this.form.isLoading = false;

      this.form.errors = updatePayPeriodBudgetResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBudgets();
        await usePayPeriodsStore().setCurrentPayPeriod(
          updatePayPeriodBudgetResponse.data
        );
      }
    },
    async detachBudgetToPayPeriod(payPeriodId, budgetId) {
      this.form.isLoading = true;

      const detachBudgetToPayPeriodResponse =
        await new PayPeriodBudgetsService().detachBudgetFromPayPeriod(
          payPeriodId,
          budgetId
        );

      this.form.isLoading = false;

      this.form.errors = detachBudgetToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBudgets();
        await usePayPeriodsStore().setCurrentPayPeriod(
          detachBudgetToPayPeriodResponse.data
        );
      }
    },
    setSelectedPayPeriodBudget(selectedPayPeriodBudget) {
      this.selectedPayPeriodBudget = selectedPayPeriodBudget;
    },
    populateFormFields(
      payPeriodId: Number,
      budgetId: Number,
      totalBalance: Number,
      remainingBalance: Number
    ) {
      this.form.payPeriodId = payPeriodId;
      this.form.budgetId = budgetId;
      this.form.totalBalance = (totalBalance / 100).toFixed(2);
      this.form.remainingBalance = (remainingBalance / 100).toFixed(2);
    },
    resetFormFields() {
      this.form.payPeriodId = -1;
      this.form.budgetId = -1;
      this.form.totalBalance = '';
      this.form.remainingBalance = '';
    },
  },
});

export default usePayPeriodBudgetsStore;
