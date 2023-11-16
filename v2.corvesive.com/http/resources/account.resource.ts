import type { IPayPeriodResource } from './payPeriods.resource';

export interface IUserResource {
  id: number;
  names: {
    first: string;
    last: string;
    full: string;
  };
  email: string;
  phone_number: string;
  pay_period: IPayPeriodResource;
  is_onboarding: Boolean;
}
