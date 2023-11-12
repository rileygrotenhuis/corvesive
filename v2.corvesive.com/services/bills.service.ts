import type {
  IAttachOrUpdatePayPeriodBillRequest,
  ICreateOrUpdateBillRequest,
} from '~/http/requests/bills.request';
import type { IBillResource } from '~/http/resources/bills.resource';
import HttpFactory from '~/services/factory';

class BillService extends HttpFactory {
  async getBills(): Promise<IBillResource[]> {
    const response = await this.call('GET', '/bills');

    return response.data;
  }

  async createBill(payload: ICreateOrUpdateBillRequest) {
    return await this.call('POST', '/bills', payload);
  }

  async updateBill(id: Number, payload: ICreateOrUpdateBillRequest) {
    return await this.call('PUT', `/bills/${id}`, payload);
  }

  async deleteBill(id: Number) {
    return await this.call('DELETE', `/bills/${id}`);
  }

  async getPayPeriodBills(payPeriodId: Number) {
    return await this.call('GET', `/pay-periods/${payPeriodId}/bills`);
  }

  async attachBillToPayPeriod(
    payPeriodId: Number,
    billId: Number,
    payload: IAttachOrUpdatePayPeriodBillRequest
  ) {
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
  ) {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/bills/${billId}`,
      payload
    );
  }

  async detachBillFromPayPeriod(payPeriodId: Number, billId: Number) {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/bills/${billId}`
    );
  }
}

export default BillService;
