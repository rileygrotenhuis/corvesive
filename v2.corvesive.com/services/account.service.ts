import type { IUpdateAccountRequest } from '~/http/requests/account.request';
import type { IUserResource } from '~/http/resources/account.resource';
import HttpFactory from '~/services/factory';

class AccountService extends HttpFactory {
  async me(): Promise<IUserResource> {
    const response = await this.call('GET', '/account/me');

    return response.data;
  }

  async updateAccount(payload: IUpdateAccountRequest) {
    return await this.call('PUT', '/account', payload);
  }

  async onboard() {
    return await this.call('PUT', '/account/onboard');
  }
}

export default AccountService;
