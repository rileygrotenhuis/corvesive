export interface IPayPeriodResource {
  id: Number;
  dates: {
    start: {
      raw: string;
      pretty: string;
    };
    end: {
      raw: string;
      pretty: string;
    };
  };
  is_complete: Boolean;
}
