import { defineStore } from 'pinia';
import BudgetsService from '~/services/budgets';
import useModalsStore from '~/stores/modals';

const useBudgetsStore = defineStore('useBudgetsStore', {
  state: () => ({
    budgets: [],
    form: {
      id: -1,
      name: '',
      amount: '',
      notes: '',
      isLoading: false,
      errors: null,
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
        parseInt(this.form.amount),
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
        parseInt(this.form.amount),
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
    populateFormFields(
      id: Number,
      name: String,
      amount: Number,
      notes: String
    ) {
      this.form.id = id;
      this.form.name = name;
      this.form.amount = (amount / 100).toFixed(2);
      this.form.notes = notes;
    },
    resetFormFields() {
      this.form.id = -1;
      this.form.name = '';
      this.form.amount = '';
      this.form.notes = '';
    },
  },
});

export default useBudgetsStore;
