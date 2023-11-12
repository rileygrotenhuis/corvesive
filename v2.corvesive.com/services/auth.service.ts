import HttpFactory from '~/services/factory';

interface IRegistrationRequest {
  firstName: string;
  lastName: string;
  email: string;
  phoneNumber: string;
  password: string;
  passwordConfirmation: string;
}

interface ILoginRequest {
  email: string;
  password: string;
}

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
