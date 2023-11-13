import type {
  IAttachOrUpdatePayPeriodBillRequest,
  ICreateOrUpdateBillRequest,
} from '~/http/requests/bills.request';
import type {
  IBillResource,
  IPayPeriodBillResource,
} from '~/http/resources/bills.resource';
import type { IHttpResource } from '~/http/resources/http.resource';
import type { IPayPeriodResource } from '~/http/resources/payPeriods.resource';
import HttpFactory from '~/services/factory';

class BillService extends HttpFactory {
  async getBills(): Promise<IHttpResource<IBillResource[]>> {
    return await this.call('GET', '/bills');
  }

  async createBill(
    payload: ICreateOrUpdateBillRequest
  ): Promise<IHttpResource<IBillResource>> {
    return await this.call('POST', '/bills', payload);
  }

  async updateBill(
    id: Number,
    payload: ICreateOrUpdateBillRequest
  ): Promise<IHttpResource<IBillResource>> {
    return await this.call('PUT', `/bills/${id}`, payload);
  }

  async deleteBill(id: Number) {
    return await this.call('DELETE', `/bills/${id}`);
  }

  async getPayPeriodBills(
    payPeriodId: Number
  ): Promise<IHttpResource<IPayPeriodBillResource[]>> {
    return await this.call('GET', `/pay-periods/${payPeriodId}/bills`);
  }

  async attachBillToPayPeriod(
    payPeriodId: Number,
    billId: Number,
    payload: IAttachOrUpdatePayPeriodBillRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
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
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/bills/${billId}`,
      payload
    );
  }

  async detachBillFromPayPeriod(
    payPeriodId: Number,
    billId: Number
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/bills/${billId}`
    );
  }
}

export default BillService;
