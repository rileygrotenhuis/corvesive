export interface IBillResource {
  id: Number;
  issuer: string;
  name: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  due_date: {
    raw: string;
    pretty: string;
  };
  notes: string;
}
