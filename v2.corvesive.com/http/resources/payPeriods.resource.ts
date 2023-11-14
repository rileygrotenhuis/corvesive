export interface IPayPeriodResource {
  id: Number;
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
