export interface IBudgetResource {
  id: Number;
  name: string;
  amount: {
    raw: Number;
    pretty: string;
  };
  notes: string;
}
