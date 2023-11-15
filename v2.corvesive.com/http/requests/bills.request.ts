export interface ICreateOrUpdateBillRequest {
  issuer: string;
  name: string;
  amount: Number;
  due_date: string;
  is_automatic: Boolean;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodBillRequest {
  amount: Number;
  due_date: string;
  is_automatic: Boolean;
}
