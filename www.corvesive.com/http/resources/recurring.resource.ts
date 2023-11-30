export interface IRecurringMetricsResource {
  income: {
    paystubs: {
      raw: number;
      pretty: string;
      input: number;
    };
  };
  expenses: {
    bills: {
      raw: number;
      pretty: string;
      input: number;
    };
    budgets: {
      raw: number;
      pretty: string;
      input: number;
    };
    savings: {
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
  };
}
