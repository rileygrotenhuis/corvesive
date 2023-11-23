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
    id: number,
    payload: ICreateOrUpdateBillRequest
  ): Promise<IHttpResource<IBillResource>> {
    return await this.call('PUT', `/bills/${id}`, payload);
  }

  async deleteBill(id: number) {
    return await this.call('DELETE', `/bills/${id}`);
  }

  async getPayPeriodBills(
    payPeriodId: number
  ): Promise<IHttpResource<IPayPeriodBillResource[]>> {
    return await this.call('GET', `/pay-periods/${payPeriodId}/bills`);
  }

  async attachBillToPayPeriod(
    payPeriodId: number,
    billId: number,
    payload: IAttachOrUpdatePayPeriodBillRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/bills/${billId}`,
      payload
    );
  }

  async updatePayPeriodBill(
    payPeriodId: number,
    billId: number,
    payload: IAttachOrUpdatePayPeriodBillRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/bills/${billId}`,
      payload
    );
  }

  async detachBillFromPayPeriod(
    payPeriodId: number,
    billId: number
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/bills/${billId}`
    );
  }

  async getPayPeriodBill(
    payPeriodId: number,
    payPeriodBillId: number
  ): Promise<IHttpResource<IPayPeriodBillResource>> {
    return await this.call(
      'GET',
      `/pay-periods/${payPeriodId}/bills/${payPeriodBillId}`
    );
  }
}

export default BillService;
