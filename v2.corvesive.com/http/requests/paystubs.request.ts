export interface ICreateOrUpdatePaystubRequest {
  issuer: string;
  type: string;
  amount: number;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodPaystubRequest {
  amount: number;
}
