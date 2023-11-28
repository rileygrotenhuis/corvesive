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
