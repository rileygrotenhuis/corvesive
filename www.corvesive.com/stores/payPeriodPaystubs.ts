import { defineStore } from 'pinia';
import usePayPeriodsStore from '~/stores/payPeriods';
import PayPeriodPaystubsService from '~/services/payPeriodPaystubs';
import useModalsStore from '~/stores/modals.ts';

const usePayPeriodPaystubsStore = defineStore('usePayPeriodPaystubsStore', {
  state: () => ({
    payPeriodPaystubs: [],
    selectedPayPeriodPaystub: {},
    form: {
      payPeriodId: -1,
      paystubId: -1,
      amount: '',
      isLoading: false,
      errors: null,
    },
  }),
  actions: {
    async getPayPeriodPaystubs() {
      const payPeriodPaystubsResponse =
        await new PayPeriodPaystubsService().getPayPeriodPaystub(
          usePayPeriodsStore().currentPayPeriod.id
        );

      this.payPeriodPaystubs = payPeriodPaystubsResponse.data;
    },
    async attachPaystubToPayPeriod() {
      this.form.isLoading = true;

      const attachPaystubToPayPeriodResponse =
        await new PayPeriodPaystubsService().attachPaystubToPayPeriod(
          this.form.payPeriodId,
          this.form.paystubId,
          parseInt(this.form.amount)
        );

      this.form.isLoading = false;

      this.form.errors = attachPaystubToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodPaystubs();
        await usePayPeriodsStore().setCurrentPayPeriod(
          attachPaystubToPayPeriodResponse.data
        );
      }
    },
    async updatePayPeriodPaystub() {
      this.form.isLoading = true;

      const updatePayPeriodPaystubResponse =
        await new PayPeriodPaystubsService().updatePayPeriodPaystub(
          this.form.payPeriodId,
          this.form.paystubId,
          parseInt(this.form.amount)
        );

      this.form.isLoading = false;

      this.form.errors = updatePayPeriodPaystubResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodPaystubs();
        await usePayPeriodsStore().setCurrentPayPeriod(
          updatePayPeriodPaystubResponse.data
        );
      }
    },
    async detachPaystubFromPayPeriod(payPeriodId, paystubId) {
      this.form.isLoading = true;

      const detachPaystubFromPayPeriodResponse =
        await new PayPeriodPaystubsService().detachPaystubFromPayPeriod(
          payPeriodId,
          paystubId
        );

      this.form.isLoading = false;

      this.form.errors = detachPaystubFromPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodPaystubs();
        await usePayPeriodsStore().setCurrentPayPeriod(
          detachPaystubFromPayPeriodResponse.data
        );
      }
    },
    setSelectedPayPeriodPaystub(selectedPayPeriodPaystub) {
      this.selectedPayPeriodPaystub = selectedPayPeriodPaystub;
    },
    populateFormFields(payPeriodId, paystubId, amount) {
      this.form.payPeriodId = payPeriodId;
      this.form.paystubId = paystubId;
      this.form.amount = (amount / 100).toFixed(2);
    },
    resetFormFields() {
      this.form.payPeriodId = -1;
      this.form.paystubId = -1;
      this.form.amount = '';
    },
  },
});

export default usePayPeriodPaystubsStore;
