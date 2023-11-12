import HttpFactory from '~/services/factory';

interface ICreateOrUpdateBillRequest {
  issuer: String;
  name: String;
  amount: Number;
  dueDate: String;
  notes: String;
}

interface IAttachOrUpdatePayPeriodBillRequest {
  amount: Number;
  due_date: String;
}

class BillService extends HttpFactory {
  async getBills(): Promise {
    return await this.call('GET', '/bills');
  }

  async createBill(payload: ICreateOrUpdateBillRequest): Promise {
    return await this.call('POST', '/bills', payload);
  }

  async updateBill(id: Number, payload: ICreateOrUpdateBillRequest): Promise {
    return await this.call('PUT', `/bills/${id}`, payload);
  }

  async deleteBill(id: Number): Promise {
    return await this.call('DELETE', `/bills/${id}`, payload);
  }

  async getPayPeriodBills(payPeriodId: Number): Promise {
    return await this.call('GET', `/pay-periods/${payPeriodId}/bills`);
  }

  async attachBillToPayPeriod(
    payPeriodId: Number,
    billId: Number,
    payload: IAttachOrUpdatePayPeriodBillRequest
  ): Promise {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/bills/${billId}`,
      payload
    );
  }

  async updatePayPeriodBill(
    payPeriodId: Number,
    billId: Number,
    payload: IAttachOrUpdatePayPeriodBillRequest
  ): Promise {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/bills/${billId}`,
      payload
    );
  }

  async detachBillFromPayPeriod(payPeriodId: Number, billId: Number): Promise {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/bills/${billId}`
    );
  }
}

export default BillService;
