export interface ICreateOrUpdateBudgetRequest {
  name: string;
  amount: number;
  notes: string;
}

export interface IAttachPayPeriodBudgetRequest {
  total_balance: number;
}

export interface IUpdatePayPeriodBudgetRequest {
  total_balance: number;
  remaining_balance: number;
}
