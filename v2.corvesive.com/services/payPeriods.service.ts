import type { ICreateOrUpdatePayPeriodRequest } from '~/http/requests/payPeriods.request';
import type { IPayPeriodResource } from '~/http/resources/payPeriods.resource';
import HttpFactory from '~/services/factory';

class PayPeriodService extends HttpFactory {
  async getPayPeriods(): Promise<IPayPeriodResource[]> {
    const response = await this.call('GET', '/pay-periods');

    return response.data;
  }

  async getPayPeriod(id: Number): Promise<IPayPeriodResource> {
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
