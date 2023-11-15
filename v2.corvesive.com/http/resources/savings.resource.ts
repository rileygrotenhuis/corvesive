import type { IPayPeriodResource } from './payPeriods.resource';

export interface ISavingResource {
  id: Number;
  name: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  notes: string;
}

export interface IPayPeriodSavingResource {
  id: Number;
  pay_period: IPayPeriodResource;
  saving: ISavingResource;
  total_balance: {
    raw: Number;
    pretty: string;
  };
  remaining_balance: {
    raw: Number;
    pretty: string;
  };
}
