import type {
  IBudgetTransactionRequest,
  IDeposiTransactionRequest,
} from '~/http/requests/transactions.request';
import type { IHttpResource } from '~/http/resources/http.resource';
import type { ITransactionResource } from '~/http/resources/transactions.resource';
import HttpFactory from '~/services/factory';

class TransactionService extends HttpFactory {
  async getPayPeriodDeposits(
    payPeriodId: number
  ): Promise<IHttpResource<ITransactionResource[]>> {
    return await this.call(
      'GET',
      `/pay-periods/${payPeriodId}/transactions/deposits`
    );
  }

  async billTransaction(
    payPeriodId: number,
    payPeriodBillId: number
  ): Promise<IHttpResource<ITransactionResource[]>> {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/bills/${payPeriodBillId}/transaction`
    );
  }

  async budgetTransaction(
    payPeriodId: number,
    payPeriodBillId: number,
    payload: IBudgetTransactionRequest
  ): Promise<IHttpResource<ITransactionResource>> {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/bills/${payPeriodBillId}/transaction`,
      payload
    );
  }

  async payPeriodDeposit(
    payPeriodId: number,
    payload: IDeposiTransactionRequest
  ): Promise<IHttpResource<ITransactionResource>> {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/deposit`,
      payload
    );
  }
}

export default TransactionService;
