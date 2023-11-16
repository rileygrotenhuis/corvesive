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
}

export default TransactionService;
