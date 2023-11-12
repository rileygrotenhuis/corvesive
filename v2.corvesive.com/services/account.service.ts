import HttpFactory from '~/services/factory';

interface IUpdateAccountRequest {
  firstName: string;
  lastName: string;
  email: string;
  phoneNumber: string;
}

class AccountService extends HttpFactory {
  async me() {
    return await this.call('GET', '/account/me');
  }

  async updateAccount(payload: IUpdateAccountRequest) {
    return await this.call('PUT', '/account', payload);
  }

  async onboard() {
    return await this.call('PUT', '/account/onboard');
  }
}

export default AccountService;
