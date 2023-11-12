export interface ICreateOrUpdatePaystubRequest {
  issuer: string;
  amount: Number;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodPaystubRequest {
  amount: Number;
}
