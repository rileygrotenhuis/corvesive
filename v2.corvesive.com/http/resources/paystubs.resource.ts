import type { IPayPeriodResource } from './payPeriods.resource';

export interface IPaystubResource {
  id: number;
  issuer: string;
  type: string;
  amount: {
    raw: number;
    pretty: string;
    input: number;
  };
  notes: string;
}

export interface IPayPeriodPaystubResource {
  id: number;
  pay_period: IPayPeriodResource;
  paystub: IPaystubResource;
  amount: {
    raw: number;
    pretty: string;
    input: number;
  };
}
