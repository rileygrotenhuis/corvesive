export interface ICreateOrUpdateBillRequest {
  issuer: string;
  name: string;
  amount: number;
  due_date: string;
  is_automatic: Boolean;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodBillRequest {
  amount: number;
  due_date: string;
  is_automatic: Boolean;
}
