import HttpFactory from '~/services/factory';

interface ICreateOrUpdatePaystubRequest {
  issuer: String;
  amount: Number;
  notes: String;
}

interface IAttachOrUpdatePayPeriodPaystubRequest {
  amount: Number;
}

class PaystubService extends HttpFactory {
  async getPaystubs(): Promise {
    return await this.call('GET', '/paystubs');
  }

  async createPaystub(payload: ICreateOrUpdatePaystubRequest): Promise {
    return await this.call('POST', '/paystubs', payload);
  }

  async updatePaystub(
    id: Number,
    payload: ICreateOrUpdatePaystubRequest
  ): Promise {
    return await this.call('PUT', `/paystubs/${id}`, payload);
  }

  async deletePaystub(id: Number): Promise {
    return await this.call('DELETE', `/paystubs/${id}`, payload);
  }

  async getPayPeriodPaystubs(payPeriodId: Number): Promise {
    return await this.call('GET', `/pay-periods/${payPeriodId}/paystubs`);
  }

  async attachPaystubToPayPeriod(
    payPeriodId: Number,
    paystubId: Number,
    payload: IAttachOrUpdatePayPeriodPaystubRequest
  ): Promise {
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
  ): Promise {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`,
      payload
    );
  }

  async detachPaystubFromPayPeriod(
    payPeriodId: Number,
    paystubId: Number
  ): Promise {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/paystubs/${paystubId}`
    );
  }
}

export default PaystubService;
