import { defineStore } from "pinia";
import useAlertsStore from "~/stores/alerts";
import usePayPeriodsStore from "~/stores/payPeriods";
import PayPeriodPaystubsService from "~/services/payPeriodPaystubs";
import useModalsStore from "~/stores/modals.js";

const usePayPeriodPaystubsStore = defineStore("usePayPeriodPaystubsStore", {
  state: () => ({
    payPeriodPaystubs: [],
    selectedPayPeriodPaystub: undefined,
    form: {
      payPeriodId: undefined,
      paystubId: undefined,
      amount: undefined,
      isLoading: false,
      errors: false,
    },
  }),
  actions: {
    async getPayPeriodPaystubs() {
      const payPeriodPaystubsResponse =
        await new PayPeriodPaystubsService().getPayPeriodPaystub(
          usePayPeriodsStore().currentPayPeriod.id,
        );

      this.payPeriodPaystubs = payPeriodPaystubsResponse.data;
    },
    async attachPaystubToPayPeriod() {
      this.form.isLoading = true;

      const attachPaystubToPayPeriodResponse =
        await new PayPeriodPaystubsService().attachPaystubToPayPeriod(
          this.form.payPeriodId,
          this.form.paystubId,
          this.form.amount,
        );

      this.form.isLoading = false;

      this.form.errors = attachPaystubToPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodPaystubs();
        await usePayPeriodsStore().setCurrentPayPeriod(
          attachPaystubToPayPeriodResponse.data,
        );
      }
    },
    async updatePayPeriodPaystub() {
      this.form.isLoading = true;

      const updatePayPeriodPaystubResponse =
        await new PayPeriodPaystubsService().updatePayPeriodPaystub(
          this.form.payPeriodId,
          this.form.paystubId,
          this.form.amount,
        );

      this.form.isLoading = false;

      this.form.errors = updatePayPeriodPaystubResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodPaystubs();
        await usePayPeriodsStore().setCurrentPayPeriod(
          updatePayPeriodPaystubResponse.data,
        );
      }
    },
    async detachPaystubFromPayPeriod(payPeriodId, paystubId) {
      this.form.isLoading = true;

      const detachPaystubFromPayPeriodResponse =
        await new PayPeriodPaystubsService().detachPaystubFromPayPeriod(
          payPeriodId,
          paystubId,
        );

      this.form.isLoading = false;

      this.form.errors = detachPaystubFromPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useModalsStore().closeModal();
        await this.getPayPeriodPaystubs();
        await usePayPeriodsStore().setCurrentPayPeriod(
          detachPaystubFromPayPeriodResponse.data,
        );
      }
    },
    setSelectedPayPeriodPaystub(selectedPayPeriodPaystub) {
      this.selectedPayPeriodPaystub = selectedPayPeriodPaystub;
    },
    populateFormFields(payPeriodId, paystubId, amount) {
      this.form = {
        payPeriodId: payPeriodId,
        paystubId: paystubId,
        amount: (amount / 100).toFixed(2),
      };
    },
    resetFormFields() {
      this.form = {
        payPeriodId: undefined,
        paystubId: undefined,
        amount: undefined,
      };
    },
  },
});

export default usePayPeriodPaystubsStore;
