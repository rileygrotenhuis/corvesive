export interface ICreateOrUpdateBillRequest {
  issuer: String;
  name: String;
  amount: Number;
  dueDate: String;
  notes: String;
}
