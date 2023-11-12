export interface ICreateOrUpdateBillRequest {
  issuer: string;
  name: string;
  amount: Number;
  dueDate: string;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodBillRequest {
  amount: Number;
  due_date: string;
}
