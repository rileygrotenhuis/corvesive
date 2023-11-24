export interface IRegistrationRequest {
  first_name: string;
  last_name: string;
  email: string;
  phone_number: string;
  password: string;
  password_confirmation: string;
}

export interface ILoginRequest {
  email: string;
  password: string;
}
