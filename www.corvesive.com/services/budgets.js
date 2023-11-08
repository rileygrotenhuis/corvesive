class BudgetsService {
  async getBudgets() {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/budgets`,
      {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
    return await response.json();
  }

  async createBudget(name, amount, notes) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/budgets`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          name: name,
          amount: amount * 100,
          notes: notes,
        }),
      }
    );
    return await response.json();
  }

  async updateBudget(budgetId, name, amount, notes) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/budgets/${budgetId}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          name: name,
          amount: amount * 100,
          notes: notes,
        }),
      }
    );
    return await response.json();
  }

  async deleteBudget(budgetId) {
    await fetch(`${useRuntimeConfig().public.apiUrl}/budgets/${budgetId}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json',
        Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
      },
    });
  }
}

export default BudgetsService;
