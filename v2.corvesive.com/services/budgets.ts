import HttpFactory from '~/services/factory';
import type { ICreateOrUpdateBudgetRequest } from '~/requests/budgets';

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
}

export default BudgetService;
