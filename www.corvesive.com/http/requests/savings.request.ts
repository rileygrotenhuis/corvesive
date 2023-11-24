export interface ICreateOrUpdateSavingRequest {
  name: string;
  amount: number;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodSavingRequest {
  amount: number;
}
