import HttpFactory from '~/services/factory';
import type { IUpdateAccountRequest } from '~/requests/account';

class AccountService extends HttpFactory {
  async me(): Promise {
    return await this.call('GET', '/account/me');
  }

  async updateAccount(payload: IUpdateAccountRequest): Promise {
    return await this.call('PUT', '/account', payload);
  }

  async onboard(): Promise {
    return await this.call('PUT', '/account/onboard');
  }
}

export default AccountService;
