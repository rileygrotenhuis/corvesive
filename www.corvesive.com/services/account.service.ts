import type { IUpdateAccountRequest } from '~/http/requests/account.request';
import type { IUserResource } from '~/http/resources/account.resource';
import type { IHttpResource } from '~/http/resources/http.resource';
import HttpFactory from '~/services/factory';

class AccountService extends HttpFactory {
  async me(): Promise<IHttpResource<IUserResource>> {
    return await this.call('GET', '/account/me');
  }

  async updateAccount(
    payload: IUpdateAccountRequest
  ): Promise<IHttpResource<IUserResource>> {
    return await this.call('PUT', '/account', payload);
  }

  async onboard(): Promise<IHttpResource<IUserResource>> {
    return await this.call('PUT', '/account/onboard');
  }
}

export default AccountService;
