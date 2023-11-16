export interface ICreateOrUpdateBudgetRequest {
  name: string;
  amount: number;
  notes: string;
}

export interface IAttachPayPeriodBudgetRequest {
  amount: number;
  total_balance: number;
}

export interface IUpdatePayPeriodBudgetRequest {
  amount: number;
  total_balance: number;
  remaining_balance: number;
}
