import { defineStore } from 'pinia';
import usePayPeriodsStore from '~/stores/payPeriods';
import PayPeriodBillsService from '~/services/payPeriodBills';
import useModalsStore from '~/stores/modals.ts';

const usePayPeriodBillsStore = defineStore('usePayPeriodBillsStore', {
  state: () => ({
    payPeriodBills: [],
    selectedPayPeriodBill: {},
    form: {
      payPeriodId: -1,
      billId: -1,
      amount: 0,
      dueDate: '',
      isLoading: false,
      errors: null,
    },
  }),
  actions: {
    async getPayPeriodBills() {
      const payPeriodBillsResponse =
        await new PayPeriodBillsService().getPayPeriodBills(
          usePayPeriodsStore().currentPayPeriod.id
        );

      this.payPeriodBills = payPeriodBillsResponse.data;
    },
    async attachBillToPayPeriod() {
      this.form.isLoading = true;

      const attachBillToPayPeriodResponse =
        await new PayPeriodBillsService().attachBillToPayPeriod(
          this.form.payPeriodId,
          this.form.billId,
          this.form.amount,
          this.form.dueDate
        );

      this.form.isLoading = false;

      this.form.errors = attachBillToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBills();
        await usePayPeriodsStore().setCurrentPayPeriod(
          attachBillToPayPeriodResponse.data
        );
      }
    },
    async updatePayPeriodBill() {
      this.form.isLoading = true;

      const updatePayPeriodBillResponse =
        await new PayPeriodBillsService().updatePayPeriodBill(
          this.form.payPeriodId,
          this.form.billId,
          this.form.amount,
          this.form.dueDate
        );

      this.form.isLoading = false;

      this.form.errors = updatePayPeriodBillResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBills();
        await usePayPeriodsStore().setCurrentPayPeriod(
          updatePayPeriodBillResponse.data
        );
      }
    },
    async detachBillToPayPeriod(payPeriodId, billId) {
      this.form.isLoading = true;

      const detachBillToPayPeriodResponse =
        await new PayPeriodBillsService().detachBillFromPayPeriod(
          payPeriodId,
          billId
        );

      this.form.isLoading = false;

      this.form.errors = detachBillToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodBills();
        await usePayPeriodsStore().setCurrentPayPeriod(
          detachBillToPayPeriodResponse.data
        );
      }
    },
    setSelectedPayPeriodBill(selectedPayPeriodBill) {
      this.selectedPayPeriodBill = selectedPayPeriodBill;
    },
    populateFormFields(
      payPeriodId: Number,
      billId: Number,
      amount: Number,
      dueDate: String
    ) {
      this.form.payPeriodId = payPeriodId;
      this.form.billId = billId;
      this.form.amount = (amount / 100).toFixed(2);
      this.form.dueDate = dueDate;
    },
    resetFormFields() {
      this.form.payPeriodId = -1;
      this.form.billId = -1;
      this.form.amount = 0;
      this.form.dueDate = '';
    },
  },
});

export default usePayPeriodBillsStore;
