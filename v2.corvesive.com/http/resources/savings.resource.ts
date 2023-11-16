import type { IPayPeriodResource } from './payPeriods.resource';

export interface ISavingResource {
  id: number;
  name: string;
  amount: {
    raw: number;
    pretty: string;
  };
  notes: string;
}

export interface IPayPeriodSavingResource {
  id: number;
  pay_period: IPayPeriodResource;
  saving_account: ISavingResource;
  amount: {
    raw: number;
    pretty: string;
  };
}
