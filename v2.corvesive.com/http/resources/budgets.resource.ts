import type { IPayPeriodResource } from './payPeriods.resource';

export interface IBudgetResource {
  id: Number;
  name: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  notes: string;
}

export interface IPayPeriodBudgetResource {
  id: Number;
  pay_period: IPayPeriodResource;
  budget: IBudgetResource;
  total_balance: {
    raw: Number;
    pretty: string;
  };
  remaining_balance: {
    raw: Number;
    pretty: string;
  };
}
