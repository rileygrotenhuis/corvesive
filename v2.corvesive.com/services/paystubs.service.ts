import type {
  IAttachOrUpdatePayPeriodPaystubRequest,
  ICreateOrUpdatePaystubRequest,
} from '~/http/requests/paystubs.request';
import type { IHttpResource } from '~/http/resources/http.resource';
import type { IPayPeriodResource } from '~/http/resources/payPeriods.resource';
import type {
  IPayPeriodPaystubResource,
  IPaystubResource,
} from '~/http/resources/paystubs.resource';
import HttpFactory from '~/services/factory';

class PaystubService extends HttpFactory {
  async getPaystubs(): Promise<IHttpResource<IPaystubResource[]>> {
    return await this.call('GET', '/paystubs');
  }

  async createPaystub(
    payload: ICreateOrUpdatePaystubRequest
  ): Promise<IHttpResource<IPaystubResource>> {
    return await this.call('POST', '/paystubs', payload);
  }

  async updatePaystub(
    id: number,
    payload: ICreateOrUpdatePaystubRequest
  ): Promise<IHttpResource<IPaystubResource>> {
    return await this.call('PUT', `/paystubs/${id}`, payload);
  }

  async deletePaystub(id: number) {
    return await this.call('DELETE', `/paystubs/${id}`);
  }

  async getPayPeriodPaystubs(
    payPeriodId: number
  ): Promise<IHttpResource<IPayPeriodPaystubResource[]>> {
    return await this.call('GET', `/pay-periods/${payPeriodId}/paystubs`);
  }

  async attachPaystubToPayPeriod(
    payPeriodId: number,
    paystubId: number,
    payload: IAttachOrUpdatePayPeriodPaystubRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      payload
    );
  }

  async updatePayPeriodPaystub(
    payPeriodId: number,
    paystubId: number,
    payload: IAttachOrUpdatePayPeriodPaystubRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      payload
    );
  }

  async detachPaystubFromPayPeriod(
    payPeriodId: number,
    paystubId: number
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`
    );
  }

  async getPayPeriodPaystub(
    payPeriodId: number,
    payPeriodPaystubId: number
  ): Promise<IHttpResource<IPayPeriodPaystubResource>> {
    return await this.call(
      'GET',
      `/pay-periods/${payPeriodId}/paystubs/${payPeriodPaystubId}`
    );
  }
}

export default PaystubService;
