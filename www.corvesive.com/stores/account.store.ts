import { defineStore } from 'pinia';
import type { IUserResource } from '~/http/resources/account.resource';

export const useAccountStore = defineStore('useAccountStore', {
  state: () => ({
    user: {} as IUserResource,
    isRecurringView: false as Boolean,
  }),
  actions: {
    async me(): Promise<IUserResource> {
      this.user = (await useNuxtApp().$api.account.me()).data;

      return this.user;
    },
    setUser(user: IUserResource): IUserResource {
      this.user = user;

      return this.user;
    },
    toggleMonthlyView() {
      useToast().add({
        title: `You have switched to your ${
          this.isRecurringView ? 'Period' : 'Recurring'
        } view`,
      });
      useToast;
      this.isRecurringView = !this.isRecurringView;
    },
  },
});
