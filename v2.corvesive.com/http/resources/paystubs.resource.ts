export interface IPaystubResource {
  id: Number;
  issuer: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  notes: string;
}
