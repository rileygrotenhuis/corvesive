import HttpFactory from '~/services/factory';

interface IRegistrationRequest {
  firstName: String;
  lastName: String;
  email: String;
  phoneNumber: String;
  password: String;
  passwordConfirmation: String;
}

interface ILoginRequest {
  email: String;
  password: String;
}

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
