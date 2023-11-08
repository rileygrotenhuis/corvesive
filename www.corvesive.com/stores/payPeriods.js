import { defineStore } from 'pinia';
import useAlertsStore from '~/stores/alerts';
import useModalsStore from '~/stores/modals';
import PayPeriodsService from '~/services/payPeriods';
import usePayPeriodMetricsStore from './payPeriodMetrics';
import handlePayPeriodAction from '~/util/handlePayPeriodAction.js';

const usePayPeriodsStore = defineStore('usePayPeriodsStore', {
  state: () => ({
    currentPayPeriod: undefined,
    payPeriods: [],
    form: {
      id: undefined,
      start_date: undefined,
      end_date: undefined,
      isLoading: false,
      errors: false
    }
  }),
  actions: {
    async getPayPeriods() {
      const payPeriodsResponse = await new PayPeriodsService().getPayPeriods();

      this.payPeriods = payPeriodsResponse.data;
    },
    async getPayPeriod(payPeriodId) {
      const payPeriodResponse = await new PayPeriodsService().getPayPeriod(payPeriodId);

      this.currentPayPeriod = payPeriodResponse.data;

      return payPeriodResponse.data;
    },
    async createPayPeriod() {
      this.form.isLoading = true;

      const createPayPeriodResponse = await new PayPeriodsService().createPayPeriod(
        this.form.start_date,
        this.form.end_date
      );

      this.form.isLoading = false;

      this.form.errors = createPayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        useAlertsStore().addAlert('createPayPeriodSuccess');
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getPayPeriods();
        this.currentPayPeriod = createPayPeriodResponse.data;
      }
    },
    async updatePayPeriod() {
      this.form.isLoading = true;

      const updatePayPeriodResponse = await new PayPeriodsService().updatePayPeriod(
        this.form.id,
        this.form.start_date,
        this.form.end_date
      );

      this.form.isLoading = false;

      this.form.errors = updatePayPeriodResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.resetFormFields();
        useModalsStore().closeModal();
        await this.getPayPeriods();
        this.currentPayPeriod = updatePayPeriodResponse.data;
      }
    },
    async deletePayPeriod() {
      if (
        window.confirm(
          'Are you sure you want to delete this pay period? It will also delete all attach resources as well.'
        )
      ) {
        this.form.isLoading = true;

        await new PayPeriodsService().deletePayPeriod(this.form.id);

        this.form.isLoading = false;

        useModalsStore().closeModal();

        this.resetFormFields();

        await this.getPayPeriods();

        await navigateTo('/monthly/paystubs');
      }
    },
    async completePayPeriod() {
      if (window.confirm('Are you sure you want to mark this Pay Period as completed')) {
        await new PayPeriodsService().completePayPeriod(this.currentPayPeriod.id);

        await this.refreshCurrentPayPeriod();
        await handlePayPeriodAction();
      }
    },
    async incompletePayPeriod() {
      if (window.confirm('Are you sure you want to mark this Pay Period as completed')) {
        await new PayPeriodsService().incompletePayPeriod(this.currentPayPeriod.id);

        await this.refreshCurrentPayPeriod();
        await handlePayPeriodAction();
      }
    },
    async setPayPeriodToCurrent(payPeriodId) {
      const setPayPeriodToCurrentResponse = await new PayPeriodsService().setPayPeriodToCurrent(
        payPeriodId
      );

      useModalsStore().closeModal();
      this.resetFormFields();
      this.currentPayPeriod = setPayPeriodToCurrentResponse.data;
      await handlePayPeriodAction();
    },
    async refreshCurrentPayPeriod() {
      if (this.currentPayPeriod) {
        this.currentPayPeriod = await this.getPayPeriod(this.currentPayPeriod.id);
      }
    },
    async setCurrentPayPeriod(currentPayPeriod) {
      this.currentPayPeriod = await this.getPayPeriod(currentPayPeriod.id);

      if (this.currentPayPeriod) {
        await usePayPeriodMetricsStore().getPayPeriodMetrics();
      }

      useModalsStore().closeModal();
    },
    populateFormFields() {
      this.form = {
        id: this.currentPayPeriod.id,
        start_date: this.currentPayPeriod.dates.start.pretty.input,
        end_date: this.currentPayPeriod.dates.end.pretty.input
      };
    },
    resetFormFields() {
      this.currentPayPeriod = undefined;
      this.form = {
        id: undefined,
        start_date: undefined,
        end_date: undefined
      };
    }
  }
});

export default usePayPeriodsStore;
