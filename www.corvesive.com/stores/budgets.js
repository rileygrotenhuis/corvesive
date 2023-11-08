import { defineStore } from 'pinia';
import BudgetsService from '~/services/budgets';
import useModalsStore from '~/stores/modals';

const useBudgetsStore = defineStore('useBudgetsStore', {
  state: () => ({
    budgets: [],
    form: {
      id: undefined,
      name: undefined,
      amount: undefined,
      notes: undefined,
      isLoading: false,
      errors: false,
    },
  }),
  actions: {
    async getBudgets() {
      const budgetsResponse = await new BudgetsService().getBudgets();

      this.budgets = budgetsResponse.data;
    },
    async createBudget() {
      this.form.isLoading = true;

      const createBudgetResponse = await new BudgetsService().createBudget(
        this.form.name,
        this.form.amount,
        this.form?.notes ?? null
      );

      this.form.isLoading = false;

      this.form.errors = createBudgetResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getBudgets();
      }
    },
    async updateBudget() {
      this.form.isLoading = true;

      const updateBudgetResponse = await new BudgetsService().updateBudget(
        this.form.id,
        this.form.name,
        this.form.amount,
        this.form?.notes ?? null
      );

      this.form.isLoading = false;

      this.form.errors = updateBudgetResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getBudgets();
      }
    },
    async deleteBudget() {
      if (window.confirm('Are you sure you want to delete this budget?')) {
        this.form.isLoading = true;

        await new BudgetsService().deleteBudget(this.form.id);

        this.form.isLoading = false;

        useModalsStore().closeModal();

        this.resetFormFields();

        await this.getBudgets();
      }
    },
    populateFormFields(id, name, amount, notes) {
      this.form = {
        id: id,
        name: name,
        amount: (amount / 100).toFixed(2),
        notes: notes,
      };
    },
    resetFormFields() {
      this.form = {
        id: undefined,
        name: undefined,
        amount: undefined,
        notes: undefined,
      };
    },
  },
});

export default useBudgetsStore;
