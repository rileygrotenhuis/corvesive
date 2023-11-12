import HttpFactory from '~/services/factory';

interface ICreateOrUpdateBudgetRequest {
  name: string;
  amount: Number;
  notes: string;
}

interface IAttachPayPeriodBudgetRequest {
  amount: Number;
  total_balance: Number;
}

interface IUpdatePayPeriodBudgetRequest {
  amount: Number;
  total_balance: Number;
  remaining_balance: Number;
}

class BudgetService extends HttpFactory {
  async getBudgets() {
    return await this.call('GET', '/budgets');
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

  async getPayPeriodBudgets(payPeriodId: Number) {
    return await this.call('GET', `/pay-periods/${payPeriodId}/budgets`);
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
