import type { IUserResource } from './account.resource';
import type { IPayPeriodBillResource } from './bills.resource';
import type { IPayPeriodBudgetResource } from './budgets.resource';

export interface ITransactionResource {
  id: Number;
  user: IUserResource;
  pay_period_bill: IPayPeriodBillResource;
  pay_period_budget: IPayPeriodBudgetResource;
  type: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  notes: string;
  dates: {
    created: {
      raw: string;
      pretty: string;
    };
  };
}
