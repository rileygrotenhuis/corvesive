class TransactionsService {
  async getPayPeriodTransactions(payPeriodId) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/transactions`,
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

  async createBillTransaction(payPeriodId, payPeriodBillId) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/bills/${payPeriodBillId}/transaction`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
    return await response.json();
  }

  async createBudgetTransaction(payPeriodId, payPeriodBudgetId, amount) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/budgets/${payPeriodBudgetId}/transaction`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          amount: amount * 100,
        }),
      }
    );
    return await response.json();
  }

  async makePayPeriodDeposit(payPeriodId, amount, notes) {
    const response = await fetch(
      `${useRuntimeConfig().public.apiUrl}/pay-periods/${payPeriodId}/deposit`,
      {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          amount: amount * 100,
          notes: notes,
        }),
      }
    );
    return await response.json();
  }

  async updateTransaction(payPeriodId, transactionId, amount, notes) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/transactions/${transactionId}`,
      {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
        body: JSON.stringify({
          amount: amount * 100,
          notes: notes,
        }),
      }
    );
    return await response.json();
  }

  async deleteTransaction(payPeriodId, transactionId) {
    const response = await fetch(
      `${
        useRuntimeConfig().public.apiUrl
      }/pay-periods/${payPeriodId}/transactions/${transactionId}`,
      {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${useCookie('corvesive_access_token').value}`,
        },
      }
    );
  }
}

export default TransactionsService;
