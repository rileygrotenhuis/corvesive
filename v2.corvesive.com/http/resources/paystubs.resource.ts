import type { IPayPeriodResource } from './payPeriods.resource';

export interface IPaystubResource {
  id: Number;
  issuer: string;
  type: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  notes: string;
}

export interface IPayPeriodPaystubResource {
  id: Number;
  pay_period: IPayPeriodResource;
  paystub: IPaystubResource;
  amount: {
    raw: Number;
    pretty: string;
  };
}
