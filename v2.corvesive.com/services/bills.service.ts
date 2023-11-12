import HttpFactory from '~/services/factory';

interface ICreateOrUpdateBillRequest {
  issuer: String;
  name: String;
  amount: Number;
  dueDate: String;
  notes: String;
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
}

export default BillService;
