import type { IPayPeriodResource } from './payPeriods.resource';

export interface IBillResource {
  id: Number;
  issuer: string;
  name: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  due_date: {
    raw: string;
    pretty: string;
  };
  notes: string;
}

export interface IPayPeriodBillResource {
  id: Number;
  pay_period: IPayPeriodResource;
  bill: IBillResource;
  amount: {
    raw: Number;
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
