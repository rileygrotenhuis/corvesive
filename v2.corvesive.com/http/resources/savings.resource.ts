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
  saving_account: ISavingResource;
  amount: {
    raw: Number;
    pretty: string;
  };
}
