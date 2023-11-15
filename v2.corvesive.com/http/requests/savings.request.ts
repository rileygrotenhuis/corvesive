export interface ICreateOrUpdateSavingRequest {
  name: string;
  amount: Number;
  notes: string;
}

export interface IAttachOrUpdatePayPeriodSavingRequest {
  amount: Number;
}
