export interface IBudgetTransactionRequest {
  amount: number;
}

export interface IDepositOrPaymentTransactionRequest {
  amount: number;
  notes: string;
}
