export interface IRegistrationRequest {
  firstName: string;
  lastName: string;
  email: string;
  phoneNumber: string;
  password: string;
  passwordConfirmation: string;
}

export interface ILoginRequest {
  email: string;
  password: string;
}
