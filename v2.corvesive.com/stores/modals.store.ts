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
  },
});
