import HttpFactory from '~/services/factory';

interface ICreateOrUpdatePaystubRequest {
  issuer: string;
  amount: Number;
  notes: string;
}

interface IAttachOrUpdatePayPeriodPaystubRequest {
  amount: Number;
}

class PaystubService extends HttpFactory {
  async getPaystubs() {
    return await this.call('GET', '/paystubs');
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

  async getPayPeriodPaystubs(payPeriodId: Number) {
    return await this.call('GET', `/pay-periods/${payPeriodId}/paystubs`);
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
