export interface ICreateOrUpdatePaystubRequest {
  issuer: string;
  type: string;
  amount: Number;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodPaystubRequest {
  amount: Number;
}
