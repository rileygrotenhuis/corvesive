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
      data: {},
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
      this.settings.open = true;
      this.settings.type = type;
      this.settings.data = data;
    },
    closeSettingsModal() {
      this.settings.open = false;
      this.settings.type = '';
      this.settings.data = {};
    },
  },
});
