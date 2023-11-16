import type { IPayPeriodResource } from './payPeriods.resource';

export interface IBillResource {
  id: number;
  issuer: string;
  name: string;
  amount: {
    raw: number;
    pretty: string;
  };
  due_date: {
    raw: string;
    pretty: string;
  };
  notes: string;
}

export interface IPayPeriodBillResource {
  id: number;
  pay_period: IPayPeriodResource;
  bill: IBillResource;
  amount: {
    raw: number;
    pretty: string;
  };
  dates: {
    due: {
      raw: string;
      pretty: {
        full: string;
        short: string;
        day: string;
        input: string;
      };
    };
  };
  has_payed: Boolean;
  status: string;
}
