import { defineStore } from 'pinia';
import type { IUserResource } from '~/http/resources/account.resource';

export const useModalStore = defineStore('useModalStore', {
  state: () => ({
    recurring: {
      open: false,
      type: 'paystubs',
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
  },
});
