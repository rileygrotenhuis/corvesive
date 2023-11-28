import type { IPayPeriodBillResource } from './bills.resource';
import type { IPayPeriodBudgetResource } from './budgets.resource';
import type { ITransactionResource } from './transactions.resource';

export interface IPayPeriodResource {
  id: number;
  dates: {
    start: {
      raw: string;
      pretty: {
        full: string;
        short: string;
        input: string;
      };
    };
    end: {
      raw: string;
      pretty: {
        full: string;
        short: string;
        input: string;
      };
    };
  };
  is_complete: Boolean;
}

export interface IPayPeriodAttributesResource {
  bills: {
    payed: IPayPeriodBillResource[];
    upcoming: IPayPeriodBillResource[];
    overdue: IPayPeriodBillResource[];
  };
  budgets: {
    remaining: IPayPeriodBudgetResource[];
    overpayed: IPayPeriodBudgetResource[];
    payed: IPayPeriodBudgetResource[];
  };
  transactions: {
    recent: ITransactionResource[];
  };
}

export interface IPayPeriodMetricsResource {
  income: {
    paystubs: {
      raw: number;
      pretty: string;
      input: number;
    };
    deposits: {
      raw: number;
      pretty: string;
      input: number;
    };
    total: {
      raw: number;
      pretty: string;
      input: number;
    };
  };
  expenses: {
    bills: {
      payed: {
        raw: number;
        pretty: string;
        input: number;
      };
      unpayed: {
        raw: number;
        pretty: string;
        input: number;
      };
      total: {
        raw: number;
        pretty: string;
        input: number;
      };
    };
    budgets: {
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
      spent: {
        raw: number;
        pretty: string;
        input: number;
      };
    };
    savings: {
      total: {
        raw: number;
        pretty: string;
        input: number;
      };
    };
    spent: {
      raw: number;
      pretty: string;
      input: number;
    };
    remaining: {
      raw: number;
      pretty: string;
      input: number;
    };
    total: {
      raw: number;
      pretty: string;
      input: number;
    };
  };
  surplus: {
    projected: {
      raw: number;
      pretty: string;
      input: number;
    };
    current: {
      raw: number;
      pretty: string;
      input: number;
    };
  };
}
