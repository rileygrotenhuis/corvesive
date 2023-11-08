import { defineStore } from 'pinia';
import useAlertsStore from '~/stores/alerts';
import usePayPeriodsStore from '~/stores/payPeriods';
import PayPeriodBudgetsService from '~/services/payPeriodBudgets';
import useModalsStore from '~/stores/modals.js';

const usePayPeriodBudgetsStore = defineStore('usePayPeriodBudgetsStore', {
  state: () => ({
    payPeriodBudgets: [],
    selectedPayPeriodBudget: undefined,
    form: {
      payPeriodId: undefined,
      budgetId: undefined,
      totalBalance: undefined,
      remainingBalance: undefined,
      isLoading: false,
      errors: false
    }
  }),
  actions: {
    async getPayPeriodBudgets() {
      const payPeriodBudgetsResponse = await new PayPeriodBudgetsService().getPayPeriodBudgets(
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
          this.form.totalBalance
        );

      this.form.isLoading = false;

      this.form.errors = attachBudgetToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBudgets();
        await usePayPeriodsStore().setCurrentPayPeriod(attachBudgetToPayPeriodResponse.data);
      }
    },
    async updatePayPeriodBudget() {
      this.form.isLoading = true;

      const updatePayPeriodBudgetResponse =
        await new PayPeriodBudgetsService().updatePayPeriodBudget(
          this.form.payPeriodId,
          this.form.budgetId,
          this.form.totalBalance,
          this.form.remainingBalance
        );

      this.form.isLoading = false;

      this.form.errors = updatePayPeriodBudgetResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBudgets();
        await usePayPeriodsStore().setCurrentPayPeriod(updatePayPeriodBudgetResponse.data);
      }
    },
    async detachBudgetToPayPeriod(payPeriodId, budgetId) {
      this.form.isLoading = true;

      const detachBudgetToPayPeriodResponse =
        await new PayPeriodBudgetsService().detachBudgetFromPayPeriod(payPeriodId, budgetId);

      this.form.isLoading = false;

      this.form.errors = detachBudgetToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBudgets();
        await usePayPeriodsStore().setCurrentPayPeriod(detachBudgetToPayPeriodResponse.data);
      }
    },
    setSelectedPayPeriodBudget(selectedPayPeriodBudget) {
      this.selectedPayPeriodBudget = selectedPayPeriodBudget;
    },
    populateFormFields(payPeriodId, budgetId, totalBalance, remainingBalance) {
      this.form = {
        payPeriodId: payPeriodId,
        budgetId: budgetId,
        totalBalance: (totalBalance / 100).toFixed(2),
        remainingBalance: (remainingBalance / 100).toFixed(2)
      };
    },
    resetFormFields() {
      this.form = {
        payPeriodId: undefined,
        budgetId: undefined,
        totalBalance: undefined,
        remainingBalance: undefined
      };
    }
  }
});

export default usePayPeriodBudgetsStore;
