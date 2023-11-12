export interface ICreateOrUpdateBudgetRequest {
  name: string;
  amount: Number;
  notes: string;
}

export interface IAttachPayPeriodBudgetRequest {
  amount: Number;
  total_balance: Number;
}

export interface IUpdatePayPeriodBudgetRequest {
  amount: Number;
  total_balance: Number;
  remaining_balance: Number;
}
