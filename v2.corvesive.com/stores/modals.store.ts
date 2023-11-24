import { defineStore } from 'pinia';

export const useModalStore = defineStore('useModalStore', {
  state: () => ({
    recurring: {
      open: false,
      type: '',
    },
    period: {
      open: false,
      type: '',
    },
    settings: {
      open: false,
      type: '',
      data: {} as any,
    },
    payPeriod: {
      open: false,
      type: '',
    },
  }),
  actions: {
    openRecurringModal(type: string) {
      this.recurring.open = true;
      this.recurring.type = type;
    },
    closeRecurringModal() {
      this.recurring.open = false;
      this.recurring.type = '';
    },
    openPeriodModal(type: string) {
      this.period.open = true;
      this.period.type = type;
    },
    closePeriodModal() {
      this.period.open = false;
      this.period.type = '';
    },
    openSettingsModal(type: string, data: object) {
      this.settings.data = data;
      this.settings.open = true;
      this.settings.type = type;
    },
    closeSettingsModal() {
      this.settings.open = false;
      this.settings.type = '';
      this.settings.data = {};
    },
    openPayPeriodModal(type: string) {
      this.payPeriod.open = true;
      this.payPeriod.type = type;
    },
    closePayPeriodModal() {
      this.payPeriod.open = false;
      this.payPeriod.type = '';
    },
  },
});
