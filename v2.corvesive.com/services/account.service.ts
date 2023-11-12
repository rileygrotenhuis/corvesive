import type { IUpdateAccountRequest } from '~/http/requests/account.request';
import HttpFactory from '~/services/factory';

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
