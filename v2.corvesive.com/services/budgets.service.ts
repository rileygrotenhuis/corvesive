import type {
  IAttachPayPeriodBudgetRequest,
  ICreateOrUpdateBudgetRequest,
  IUpdatePayPeriodBudgetRequest,
} from '~/http/requests/budgets.request';
import type {
  IBudgetResource,
  IPayPeriodBudgetResource,
} from '~/http/resources/budgets.resource';
import HttpFactory from '~/services/factory';

class BudgetService extends HttpFactory {
  async getBudgets(): Promise<IBudgetResource[]> {
    const response = await this.call('GET', '/budgets');

    return response.data;
  }

  async createBudget(payload: ICreateOrUpdateBudgetRequest) {
    return await this.call('POST', '/budgets', payload);
  }

  async updateBudget(id: Number, payload: ICreateOrUpdateBudgetRequest) {
    return await this.call('PUT', `/budgets/${id}`, payload);
  }

  async deleteBudget(id: Number) {
    return await this.call('DELETE', `/budgets/${id}`);
  }

  async getPayPeriodBudgets(
    payPeriodId: Number
  ): Promise<IPayPeriodBudgetResource[]> {
    const response = await this.call(
      'GET',
      `/pay-periods/${payPeriodId}/budgets`
    );

    return response.data;
  }

  async attachBudgetToPayPeriod(
    payPeriodId: Number,
    budgetId: Number,
    payload: IAttachPayPeriodBudgetRequest
  ) {
    return await this.call(
      'POST',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`,
      payload
    );
  }

  async updatePayPeriodBudget(
    payPeriodId: Number,
    budgetId: Number,
    payload: IUpdatePayPeriodBudgetRequest
  ) {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`,
      payload
    );
  }

  async detachBudgetFromPayPeriod(payPeriodId: Number, budgetId: Number) {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`
    );
  }
}

export default BudgetService;
