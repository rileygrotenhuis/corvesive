export interface ICreateOrUpdateSavingRequest {
  name: string;
  amount: Number;
  notes: string;
}

export interface IAttachPayPeriodSavingRequest {
  amount: Number;
  total_balance: Number;
}

export interface IUpdatePayPeriodSavingRequest {
  amount: Number;
  total_balance: Number;
  remaining_balance: Number;
}
