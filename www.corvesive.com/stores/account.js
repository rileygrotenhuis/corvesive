import { defineStore } from 'pinia';
import AccountService from '~/services/account';
import useModalsStore from '~/stores/modals';

const useAccountStore = defineStore('useAccountStore', {
  state: () => ({
    user: undefined,
    form: {
      firstName: undefined,
      lastName: undefined,
      email: undefined,
      phoneNumber: undefined,
      isLoading: false,
      errors: undefined,
    },
  }),
  actions: {
    setUser(user) {
      this.user = user;
    },
    async me() {
      const meResponse = await new AccountService().me();

      this.user = meResponse.data;
    },
    async updateAccount() {
      this.form.isLoading = true;

      const updateAccountResponse = await new AccountService().updateAccount(
        this.form.firstName,
        this.form.lastName,
        this.form.email,
        this.form.phoneNumber
      );

      this.form.isLoading = false;

      this.form.errors = updateAccountResponse.errors ?? undefined;

      if (!this.form.errors) {
        this.user = updateAccountResponse.user ?? undefined;
        useModalsStore().closeModal();
        await this.me();
      }
    },
    async onboardUser() {
      this.form.isLoading = true;

      const onboardUserResponse = await new AccountService().onboard();

      this.form.isLoading = false;

      this.form.errors = onboardUserResponse.errors ?? undefined;

      if (!this.form.errors) {
        await this.me();
      }
    },
    populateFormFields() {
      this.form = {
        firstName: this.user.names.first,
        lastName: this.user.names.last,
        email: this.user.email,
        phoneNumber: this.user.phone_number,
      };
    },
  },
});

export default useAccountStore;
