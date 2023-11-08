import { defineStore } from 'pinia';
import BillsService from '~/services/bills';
import useModalsStore from '~/stores/modals';

const useBillsStore = defineStore('useBillsStore', {
  state: () => ({
    bills: [],
    form: {
      id: -1,
      issuer: '',
      name: '',
      amount: 0,
      due_date: '',
      notes: '',
      isLoading: false,
      errors: false,
    },
  }),
  actions: {
    async getBills() {
      const billsResponse = await new BillsService().getBills();

      this.bills = billsResponse.data;
    },
    async createBill() {
      this.form.isLoading = true;

      const createBillResponse = await new BillsService().createBill(
        this.form.issuer,
        this.form.name,
        this.form.amount,
        this.form.due_date,
        this.form?.notes ?? null
      );

      this.form.isLoading = false;

      this.form.errors = createBillResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getBills();
      }
    },
    async updateBill() {
      this.form.isLoading = true;

      const updateBillResponse = await new BillsService().updateBill(
        this.form.id,
        this.form.issuer,
        this.form.name,
        this.form.amount,
        this.form.due_date,
        this.form?.notes ?? null
      );

      this.form.isLoading = false;

      this.form.errors = updateBillResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getBills();
      }
    },
    async deleteBill() {
      if (window.confirm('Are you sure you want to delete this bill?')) {
        this.form.isLoading = true;

        await new BillsService().deleteBill(this.form.id);

        this.form.isLoading = false;

        useModalsStore().closeModal();

        this.resetFormFields();

        await this.getBills();
      }
    },
    populateFormFields(
      id: Number,
      issuer: String,
      name: String,
      amount: Number,
      dueDate: String,
      notes: String
    ) {
      this.form.id = id;
      this.form.issuer = issuer;
      this.form.name = name;
      this.form.amount = (amount / 100).toFixed(2);
      this.form.due_date = dueDate.toString();
      this.form.notes = notes;
    },
    resetFormFields() {
      this.form.id = -1;
      this.form.issuer = '';
      this.form.name = '';
      this.form.amount = 0;
      this.form.due_date = '';
      this.form.notes = '';
    },
  },
});

export default useBillsStore;
