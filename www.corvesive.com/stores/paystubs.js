import { defineStore } from 'pinia';
import useModalsStore from '~/stores/modals';
import PaystubsService from '~/services/paystubs';

const usePaystubsStore = defineStore('usePaystubsStore', {
  state: () => ({
    paystubs: [],
    form: {
      id: undefined,
      issuer: undefined,
      amount: undefined,
      notes: undefined,
      isLoading: false,
      errors: false
    }
  }),
  actions: {
    async getPaystubs() {
      const paystubsResponse = await new PaystubsService().getPaystubs();

      this.paystubs = paystubsResponse.data;
    },
    async createPaystub() {
      this.form.isLoading = true;

      const createPaystubResponse = await new PaystubsService().createPaystub(
        this.form.issuer,
        this.form.amount,
        this.form?.notes ?? null
      );

      this.form.isLoading = false;

      this.form.errors = createPaystubResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getPaystubs();
      }
    },
    async updatePaystub() {
      this.form.isLoading = true;

      const updatePaystubResponse = await new PaystubsService().updatePaystub(
        this.form.id,
        this.form.issuer,
        this.form.amount,
        this.form?.notes ?? null
      );

      this.form.isLoading = false;

      this.form.errors = updatePaystubResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getPaystubs();
      }
    },
    async deletePaystub() {
      if (window.confirm('Are you sure you want to delete this paystub?')) {
        this.form.isLoading = true;

        await new PaystubsService().deletePaystub(this.form.id);

        this.form.isLoading = false;

        useModalsStore().closeModal();

        this.resetFormFields();

        await this.getPaystubs();
      }
    },
    populateFormFields(id, issuer, amount, notes) {
      this.form = {
        id: id,
        issuer: issuer,
        amount: (amount / 100).toFixed(2),
        notes: notes
      };
    },
    resetFormFields() {
      this.form = {
        id: undefined,
        issuer: undefined,
        amount: undefined,
        notes: undefined
      };
    }
  }
});

export default usePaystubsStore;
