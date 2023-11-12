import HttpFactory from '~/services/factory';

interface ICreateOrUpdateBudgetRequest {
  name: String;
  amount: Number;
  notes: String;
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
  async getBudgets(): Promise {
    return await this.call('GET', '/budgets');
  }

  async createBudget(payload: ICreateOrUpdateBudgetRequest): Promise {
    return await this.call('POST', '/budgets', payload);
  }

  async updateBudget(
    id: Number,
    payload: ICreateOrUpdateBudgetRequest
  ): Promise {
    return await this.call('PUT', `/budgets/${id}`, payload);
  }

  async deleteBudget(id: Number): Promise {
    return await this.call('DELETE', `/budgets/${id}`, payload);
  }

  async getPayPeriodBudgets(payPeriodId: Number): Promise {
    return await this.call('GET', `/pay-periods/${payPeriodId}/budgets`);
  }

  async attachBudgetToPayPeriod(
    payPeriodId: Number,
    budgetId: Number,
    payload: IAttachPayPeriodBudgetRequest
  ): Promise {
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
  ): Promise {
    return await this.call(
      'PUT',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`,
      payload
    );
  }

  async detachBudgetFromPayPeriod(
    payPeriodId: Number,
    budgetId: Number
  ): Promise {
    return await this.call(
      'DELETE',
      `/pay-periods/${payPeriodId}/budgets/${budgetId}`
    );
  }
}

export default BudgetService;
