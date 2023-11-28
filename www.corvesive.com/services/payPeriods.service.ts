import type { ICreateOrUpdatePayPeriodRequest } from '~/http/requests/payPeriods.request';
import type { IHttpResource } from '~/http/resources/http.resource';
import type {
  IPayPeriodMetricsResource,
  IPayPeriodResource,
} from '~/http/resources/payPeriods.resource';
import HttpFactory from '~/services/factory';

class PayPeriodService extends HttpFactory {
  async getPayPeriods(): Promise<IHttpResource<IPayPeriodResource[]>> {
    return await this.call('GET', '/pay-periods');
  }

  async getPayPeriod(id: number): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call('GET', `/pay-periods/${id}`);
  }

  async createPayPeriod(
    autoGenerateResources: Boolean,
    payload: ICreateOrUpdatePayPeriodRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    const url: string = `/pay-periods${
      autoGenerateResources ? '?auto_generate_resources=1' : ''
    }`;

    return await this.call('POST', url, payload);
  }

  async updatePayPeriod(
    id: number,
    payload: ICreateOrUpdatePayPeriodRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call('PUT', `/pay-periods/${id}`, payload);
  }

  async deletePayPeriod(id: number) {
    return await this.call('DELETE', `/pay-periods/${id}`);
  }

  async getPayPeriodMetrics(
    id: number
  ): Promise<IHttpResource<IPayPeriodMetricsResource>> {
    return await this.call('GET', `/pay-periods/${id}/metrics`);
  }
}

export default PayPeriodService;
