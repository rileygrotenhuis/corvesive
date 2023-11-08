import { defineStore } from "pinia";
import BillsService from "~/services/bills";
import useModalsStore from "~/stores/modals";

const useBillsStore = defineStore("useBillsStore", {
  state: () => ({
    bills: [],
    form: {
      id: undefined,
      issuer: undefined,
      name: undefined,
      amount: undefined,
      due_date: undefined,
      notes: undefined,
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
        this.form?.notes ?? null,
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
        this.form?.notes ?? null,
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
      if (window.confirm("Are you sure you want to delete this bill?")) {
        this.form.isLoading = true;

        await new BillsService().deleteBill(this.form.id);

        this.form.isLoading = false;

        useModalsStore().closeModal();

        this.resetFormFields();

        await this.getBills();
      }
    },
    populateFormFields(id, issuer, name, amount, dueDate, notes) {
      this.form = {
        id: id,
        issuer: issuer,
        name: name,
        amount: (amount / 100).toFixed(2),
        due_date: dueDate.toString(),
        notes: notes,
      };
    },
    resetFormFields() {
      this.form = {
        id: undefined,
        issuer: undefined,
        name: undefined,
        amount: undefined,
        due_date: undefined,
        notes: undefined,
      };
    },
  },
});

export default useBillsStore;
