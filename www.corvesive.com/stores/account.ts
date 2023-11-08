import { defineStore } from 'pinia';
import AccountService from '~/services/account';
import useModalsStore from '~/stores/modals';

const useAccountStore = defineStore('useAccountStore', {
  state: () => ({
    user: undefined,
    form: {
      firstName: '',
      lastName: '',
      email: '',
      phoneNumber: '',
      isLoading: false,
      errors: null,
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
      this.form.firstName = this.user.names.first;
      this.form.lastName = this.user.names.last;
      this.form.email = this.user.email;
      this.form.phoneNumber = this.user.phone_number;
    },
  },
});

export default useAccountStore;
