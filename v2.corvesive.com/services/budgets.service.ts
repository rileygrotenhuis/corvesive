import type {
  IAttachPayPeriodBudgetRequest,
  ICreateOrUpdateBudgetRequest,
  IUpdatePayPeriodBudgetRequest,
} from '~/http/requests/budgets.request';
import type {
  IBudgetResource,
  IPayPeriodBudgetResource,
} from '~/http/resources/budgets.resource';
import type { IHttpResource } from '~/http/resources/http.resource';
import type { IPayPeriodResource } from '~/http/resources/payPeriods.resource';
import HttpFactory from '~/services/factory';

class BudgetService extends HttpFactory {
  async getBudgets(): Promise<IHttpResource<IBudgetResource[]>> {
    return await this.call('GET', '/budgets');
  }

  async createBudget(
    payload: ICreateOrUpdateBudgetRequest
  ): Promise<IHttpResource<IBudgetResource>> {
    return await this.call('POST', '/budgets', payload);
  }

  async updateBudget(
    id: number,
    payload: ICreateOrUpdateBudgetRequest
  ): Promise<IHttpResource<IBudgetResource>> {
    return await this.call('PUT', `/budgets/${id}`, payload);
  }

  async deleteBudget(id: number) {
    return await this.call('DELETE', `/budgets/${id}`);
  }

  async getPayPeriodBudgets(
    payPeriodId: number
  ): Promise<IHttpResource<IPayPeriodBudgetResource[]>> {
    return await this.call('GET', `/pay-periods/${payPeriodId}/budgets`);
  }

  async attachBudgetToPayPeriod(
    payPeriodId: number,
    budgetId: number,
    payload: IAttachPayPeriodBudgetRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`,
      payload
    );
  }

  async updatePayPeriodBudget(
    payPeriodId: number,
    budgetId: number,
    payload: IUpdatePayPeriodBudgetRequest
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`,
      payload
    );
  }

  async detachBudgetFromPayPeriod(
    payPeriodId: number,
    budgetId: number
  ): Promise<IHttpResource<IPayPeriodResource>> {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`
    );
  }
}

export default BudgetService;
