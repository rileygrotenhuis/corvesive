import type { IPayPeriodResource } from './payPeriods.resource';

export interface IBudgetResource {
  id: number;
  name: string;
  amount: {
    raw: number;
    pretty: string;
    input: number;
  };
  notes: string;
}

export interface IPayPeriodBudgetResource {
  id: number;
  pay_period: IPayPeriodResource;
  budget: IBudgetResource;
  total_balance: {
    raw: number;
    pretty: string;
    input: number;
  };
  remaining_balance: {
    raw: number;
    pretty: string;
    input: number;
  };
}
