import { defineStore } from 'pinia';
import AuthService from '~/services/auth';
import useAccountStore from '~/stores/account';

const useAuthStore = defineStore('useAuthStore', {
  state: () => ({
    registrationForm: {
      firstName: '',
      lastName: '',
      email: '',
      phoneNumber: '',
      password: '',
      passwordConfirmation: '',
      isLoading: false,
      errors: null,
    },
    loginForm: {
      email: '',
      password: '',
      isLoading: false,
      errors: null,
    },
  }),
  actions: {
    async register() {
      this.registrationForm.isLoading = true;

      const registrationResponse = await new AuthService().register(
        this.registrationForm.firstName,
        this.registrationForm.lastName,
        this.registrationForm.email,
        this.registrationForm.phoneNumber,
        this.registrationForm.password,
        this.registrationForm.passwordConfirmation
      );

      this.registrationForm.isLoading = false;

      this.registrationForm.errors = registrationResponse.errors ?? undefined;

      if (!this.registrationForm.errors) {
        useAccountStore().setUser(registrationResponse.user ?? {});
        useCookie('corvesive_access_token').value = registrationResponse.token;
        await navigateTo('/dashboard');
      }
    },
    async login() {
      this.loginForm.isLoading = true;

      const loginResponse = await new AuthService().login(
        this.loginForm.email,
        this.loginForm.password
      );

      this.loginForm.isLoading = false;

      this.loginForm.errors = loginResponse.errors ?? undefined;

      if (!this.loginForm.errors) {
        useAccountStore().setUser(loginResponse.user ?? {});
        useCookie('corvesive_access_token').value = loginResponse.token;
        await navigateTo('/dashboard');
      }
    },
    async logout() {
      await new AuthService().logout();
      await navigateTo('/login');
    },
  },
});

export default useAuthStore;
