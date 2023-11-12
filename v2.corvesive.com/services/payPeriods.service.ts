import HttpFactory from '~/services/factory';

interface ICreateOrUpdatePayPeriodRequest {
  start_date: String;
  end_date: String;
}

class PayPeriodService extends HttpFactory {
  async getPayPeriods(): Promise {
    return await this.call('GET', '/pay-periods');
  }

  async createPayPeriod(
    autoGenerateResources: Boolean,
    payload: ICreateOrUpdatePayPeriodRequest
  ): Promise {
    const url: String = `/pay-periods${
      autoGenerateResources ? '?auto_generate_resources=1' : ''
    }`;

    return await this.call('POST', url, payload);
  }

  async updatePayPeriod(
    id: Number,
    payload: ICreateOrUpdatePayPeriodRequest
  ): Promise {
    return await this.call('PUT', `/pay-periods/${id}`, payload);
  }

  async deletePayPeriod(id: Number): Promise {
    return await this.call('DELETE', `/pay-periods/${id}`, payload);
  }
}

export default PayPeriodService;
