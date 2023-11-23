import type {
  IAttachOrUpdatePayPeriodSavingRequest,
  ICreateOrUpdateSavingRequest,
} from '~/http/requests/savings.request';
import type {
  ISavingResource,
  IPayPeriodSavingResource,
} from '~/http/resources/savings.resource';
import type { IHttpResource } from '~/http/resources/http.resource';
import type { IPayPeriodResource } from '~/http/resources/payPeriods.resource';
import HttpFactory from '~/services/factory';

class SavingService extends HttpFactory {
  async getSavings(): Promise<IHttpResource<ISavingResource[]>> {
    return await this.call('GET', '/savings');
  }

  async getSaving(id: number): Promise<IHttpResource<ISavingResource>> {
    return await this.call('GET', `/savings/${id}`);
  }

  async createSaving(
    payload: ICreateOrUpdateSavingRequest
  ): Promise<IHttpResource<ISavingResource>> {
    return await this.call('POST', '/savings', payload);
  }

  async updateSaving(
    id: number,
    payload: ICreateOrUpdateSavingRequest
  ): Promise<IHttpResource<ISavingResource>> {
    return await this.call('PUT', `/savings/${id}`, payload);
  }

  async deleteSaving(id: number) {
    return await this.call('DELETE', `/savings/${id}`);
  }

  async getPayPeriodSavings(
    payPeriodId: number
  ): Promise<IHttpResource<IPayPeriodSavingResource[]>> {
    return await this.call('GET', `/pay-periods/${payPeriodId}/savings`);
  }

  async getPayPeriodSaving(
    payPeriodId: number,
    payPeriodSavingId: number
  ): Promise<IHttpResource<IPayPeriodSavingResource>> {
    return await this.call(
      'GET',
      `/pay-periods/${payPeriodId}/savings/${payPeriodSavingId}`
    );
  }

  async attachSavingToPayPeriod(
    payPeriodId: number,
    savingId: number,
    payload: IAttachOrUpdatePayPeriodSavingRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/savings/${savingId}`,
      payload
    );
  }

  async updatePayPeriodSaving(
    payPeriodId: number,
    savingId: number,
    payload: IAttachOrUpdatePayPeriodSavingRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/savings/${savingId}`,
      payload
    );
  }

  async detachSavingFromPayPeriod(
    payPeriodId: number,
    savingId: number
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/savings/${savingId}`
    );
  }
}

export default SavingService;
