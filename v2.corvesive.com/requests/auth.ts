export interface IRegistrationRequest {
  firstName: String;
  lastName: String;
  email: String;
  phoneNumber: String;
  password: String;
  passwordConfirmation: String;
}

export interface ILoginRequest {
  email: String;
  password: String;
}
