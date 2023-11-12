import type {
  ILoginRequest,
  IRegistrationRequest,
} from '~/http/requests/auth.request';
import HttpFactory from '~/services/factory';

class AuthService extends HttpFactory {
  async register(payload: IRegistrationRequest) {
    return await this.call('POST', '/register', payload);
  }

  async login(payload: ILoginRequest) {
    return await this.call('POST', '/login', payload);
  }

  async logout() {
    return await this.call('DELETE', '/logout');
  }
}

export default AuthService;
