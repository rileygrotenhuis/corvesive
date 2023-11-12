import type {
  IAttachOrUpdatePayPeriodPaystubRequest,
  ICreateOrUpdatePaystubRequest,
} from '~/http/requests/paystubs.request';
import type {
  IPayPeriodPaystubResource,
  IPaystubResource,
} from '~/http/resources/paystubs.resource';
import HttpFactory from '~/services/factory';

class PaystubService extends HttpFactory {
  async getPaystubs(): Promise<IPaystubResource> {
    const response = await this.call('GET', '/paystubs');

    return response.data;
  }

  async createPaystub(payload: ICreateOrUpdatePaystubRequest) {
    return await this.call('POST', '/paystubs', payload);
  }

  async updatePaystub(id: Number, payload: ICreateOrUpdatePaystubRequest) {
    return await this.call('PUT', `/paystubs/${id}`, payload);
  }

  async deletePaystub(id: Number) {
    return await this.call('DELETE', `/paystubs/${id}`);
  }

  async getPayPeriodPaystubs(
    payPeriodId: Number
  ): Promise<IPayPeriodPaystubResource> {
    const response = await this.call(
      'GET',
      `/pay-periods/${payPeriodId}/paystubs`
    );

    return response.data;
  }

  async attachPaystubToPayPeriod(
    payPeriodId: Number,
    paystubId: Number,
    payload: IAttachOrUpdatePayPeriodPaystubRequest
  ) {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      payload
    );
  }

  async updatePayPeriodPaystub(
    payPeriodId: Number,
    paystubId: Number,
    payload: IAttachOrUpdatePayPeriodPaystubRequest
  ) {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      payload
    );
  }

  async detachPaystubFromPayPeriod(payPeriodId: Number, paystubId: Number) {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`
    );
  }
}

export default PaystubService;
