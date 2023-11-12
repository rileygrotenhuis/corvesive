import HttpFactory from '~/services/factory';
import type { ILoginRequest, IRegistrationRequest } from '~/requests/auth';

class AuthService extends HttpFactory {
  async register(payload: IRegistrationRequest): Promise {
    return await this.call('POST', '/register', payload);
  }

  async login(payload: ILoginRequest): Promise {
    return await this.call('POST', '/login', payload);
  }

  async logout(): Promise {
    return await this.call('DELETE', '/logout');
  }
}

export default AuthService;
