import type { ICreateOrUpdatePayPeriodRequest } from '~/http/requests/payPeriods.request';
import HttpFactory from '~/services/factory';

class PayPeriodService extends HttpFactory {
  async getPayPeriods() {
    return await this.call('GET', '/pay-periods');
  }

  async getPayPeriod(id: Number) {
    return await this.call('GET', `/pay-periods/${id}`);
  }

  async createPayPeriod(
    autoGenerateResources: Boolean,
    payload: ICreateOrUpdatePayPeriodRequest
  ) {
    const url: string = `/pay-periods${
      autoGenerateResources ? '?auto_generate_resources=1' : ''
    }`;

    return await this.call('POST', url, payload);
  }

  async updatePayPeriod(id: Number, payload: ICreateOrUpdatePayPeriodRequest) {
    return await this.call('PUT', `/pay-periods/${id}`, payload);
  }

  async deletePayPeriod(id: Number) {
    return await this.call('DELETE', `/pay-periods/${id}`);
  }
}

export default PayPeriodService;
